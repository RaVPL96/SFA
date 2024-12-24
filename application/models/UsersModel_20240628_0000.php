<?php

require('Setuplockpbkdf2model.php');

class UsersModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
        $this->load->helper('url');
    }

    //LOGIN
    function assert_true($result) {
        if ($result === true) {
            return 'pass';
        } else {
            return 'fail';
        }
    }

    function logMeIn($user, $pw, $location) {
        $loginData = array(
            'username' => $user,
            'active' => 1,
            'deleted' => 0,
            'resetpw' => 0,
            'suspend' => 0
        );

        $this->db->from('useracc');
        $this->db->join('user_type', 'useracc.role=user_type.id', 'left');
        $this->db->where($loginData);
        $query = $this->db->get();
        $count = $query->num_rows(); //$sth->rowCount();

        if ($count === 1 && $this->validateUserLocation($user, $location)) {
            //userfound
            $result = $query->result_array();
            //print_r($result);
            foreach ($result as $row) {
                $rowPw = $row['passcode'];
                $rowName = $row['profname'];
                $rowUName = $row['username'];
                $rowRole = $row['role'];
                $grade_id = $row['grade_id'];
                $rowCusID = $row['cus_id'];
                $roleName = $row['name'];
                $rowPic = $row['profilepic'];
                $rowUID = $row['email'];
                $roleSince = $row['createddate'];
            }
            $passvalidator = new setuplockpbkdf2MODEL();
            if ($this->assert_true($passvalidator->validate_password($pw, $rowPw)) === 'pass') {
                $newdata = array(
                    'profname' => $rowName,
                    'username' => $rowUName,
                    'email' => $rowUID,
                    'urole' => $rowRole,
                    'grade_id' => $grade_id,
                    'ucusid' => $rowCusID, //dealer customer customer id
                    'urolename' => $roleName,
                    'since' => $roleSince,
                    'pic' => $rowPic,
                    'location' => $location,
                    'logged_in' => TRUE
                );
                //insert to log database
                
                $arrLogIn=array(
                    'application'=>'web',
                    'uid' => $rowUName,
                    'date'=>date('Y-m-d'),
                    'login_time'=>date('Y-m-d H:i:s')
                );
                $this->db->insert('`tbl_trns_users_app_login`',$arrLogIn);
                //
                //print_r($newdata);
                $this->session->set_userdata('User', $newdata);
                header('Location:' . base_url('index.php/welcome/homeReport'));
            } else {
                //echo 'fail';die();
                header('Location:' . base_url('index.php/users/index/fail'));
            }
        } else {//no user found
            header('Location:' . base_url('index.php/users/index/fail'));
        }
        $this->db->close();
    }

    function validateUserLocation($user, $location) {
        $loginData = array(
            'username' => $user,
            'location_id' => $location,
            'useracc_ic_location.isact' => 1,
            'active' => 1,
            'deleted' => 0,
            'resetpw' => 0,
            'suspend' => 0
        );
        $this->db->select('ic_locations.name');
        $this->db->from('useracc');
        $this->db->join('useracc_ic_location', 'useracc.username=useracc_ic_location.user_id', 'left');
        $this->db->join('ic_locations', 'useracc_ic_location.location_id=ic_locations.id', 'left');
        $this->db->where($loginData);
        $query = $this->db->get();
        $count = $query->num_rows();
        $result = $query->row();
        if ($count === 1) {//userfound in location 
            $locname = $result->name;
            $this->session->set_userdata('Location', $locname);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout() {
        $this->session->unset_userdata('User');
        $this->session->sess_destroy();
        header('Location:' . base_url('index.php/users/index'));
    }
    
    function getLoginAudit($dateFrom=null,$dateTo=null,$userID=null){
        $this->db->select('`id`, `application`, `uid`, `date`, `login_time`,`username`, `email`,  `departmentID`, `useracc`.`grade_id`, `profilepic`, `profname`, `mobile`, `res_mobile`, `off_mobile`, `active`, `deleted`, `hash`, `resetpw`, `suspend`, `createddate`,`company_organization_structure`.`grade_name`');
        $this->db->from('`tbl_trns_users_app_login`');
        $this->db->join('`useracc`','`tbl_trns_users_app_login`.`uid`=`useracc`.`username`','INNER');
        $this->db->join('`company_organization_structure`','`useracc`.`grade_id`=`company_organization_structure`.`grade_id`','INNER');
        if(!empty($dateFrom) && isset($dateFrom)){
            $this->db->where('`date`>=',$dateFrom);
        }
        if(!empty($dateTo) && isset($dateTo)){
            $this->db->where('`date`<=',$dateTo);
        }
        if(!empty($userID) && isset($userID)){
            $this->db->where('`uid`',$userID);
        }
        $this->db->order_by('`username`,`login_time`','ASC');
        $q = $this->db->get();
        
        $result = $q->result_array();
        return $result;
    }

    /* ====CREATE ACCOUNT=========== */

    //to get ASE allowed areas
    function getAllowedAreas($username) {
        $this->db->select('`id`, `user_name`, `area_id`, `range_id`');
        $this->db->from('`tbl_user_area`');
        $this->db->where('`user_name`', $username);
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;
    }

    function createAcc($data) {
        $dataSet = $data['post']['user'];
        $role = $dataSet['type'];
        $saveas = $dataSet['saveas'];

        $cusid = 0;
        if (!empty($data['job']['cusname']) && !empty($data['job']['cusid']) && isset($data['job']['cusname']) && isset($data['job']['cusid'])) {
            $cusid = $data['job']['cusid'];
        } else {
            $cusid = 0;
        }
//echo $cusid;die();
        $profilePic = 'avatar5.png';
        if (isset($_POST) && $dataSet['pic'] == 'delete' && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['profilepic']) && !empty($_FILES['profilepic'])) {
            $result = $this->uploadUserPic();
            if ($result !== false) {
                $profilePic = $result;
            } else {
                
            }
        } else {
            $profilePic = $dataSet['pic'];
        }
        //      print_r($_FILES);
//echo $profilePic;die();
        if ($saveas == 'new') {//new user creation
            $values = array(
                'usertype' => $dataSet['type'],
                'profilepic' => $profilePic,
                'profname' => $dataSet['profname'],
                'username' => $dataSet['uname'],
                'mobile' => $dataSet['umobile'],
                'customer_id' => $cusid,
                'res_mobile' => $dataSet['urmobile'] = $dataSet['umobile'], //temporary solution
                'off_mobile' => $dataSet['uomobile'] = $dataSet['umobile'], //temporary solution
                'pass' => $dataSet['pass'],
                'repass' => $dataSet['repass'],
                'email' => $dataSet['email'],
                'departmentID' => $dataSet['department'],
                'grade_id' => $dataSet['grade']
            );

            if (!$this->validateUserBeforeAdd($dataSet['uname'])) {
                if ($this->saveRequest($values, $role)) {
                    header('Location:' . base_url('index.php/users/createAcc/ok'));
                } else {
                    header('Location:' . base_url('index.php/users/createAcc/fail'));
                }
            } else {
                header('Location:' . base_url('index.php/users/createAcc/fail'));
            }
        } else {//update request
            $act = 1;

            if (!empty($dataSet['active']) && isset($dataSet['active'])) {
                $act = $dataSet['active'];
            } else {
                $act = 0;
            }
            $values = array(
                'usertype' => $dataSet['type'],
                'profilepic' => $profilePic,
                'customer_id' => $cusid,
                'username' => $dataSet['uname'],
                'profname' => $dataSet['profname'],
                'mobile' => $dataSet['umobile'],
                'res_mobile' => $dataSet['urmobile'] = $dataSet['umobile'], //temporary solution
                'off_mobile' => $dataSet['uomobile'] = $dataSet['umobile'], //temporary solution
                'pass' => $dataSet['pass'],
                'repass' => $dataSet['repass'],
                'email' => $dataSet['email'],
                'isact' => $act,
                'departmentID' => $dataSet['department'],
                'grade_id' => $dataSet['grade']
            );
            //print_r($values);die();
            if ($this->validateUserBeforeAdd($dataSet['uname'])) {
                if ($this->updateRequest($values, $role)) {
                    header('Location:' . base_url('index.php/users/createAcc/ok'));
                } else {
                    header('Location:' . base_url('index.php/users/createAcc/fail'));
                }
            } else {
                header('Location:' . base_url('index.php/users/createAcc/fail'));
            }
        }
    }

    function uploadUserPic() {
        $session_id = '1'; // User session id
        $path = PROFILEPICPATH;
        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG");
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['profilepic']) && !empty($_FILES['profilepic'])) {
            $name = $_FILES['profilepic']['name'];
            $size = $_FILES['profilepic']['size'];
            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);

                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) { // Image size max 1 MB
                        $actual_image_name = time() . $session_id . "." . $ext;
                        $tmp = $_FILES['profilepic']['tmp_name'];
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                            //mysqli_query($db, "UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
                            //echo "<img src=\"$path" . $actual_image_name . "\" class=\"preview\" />";
                            return $actual_image_name;
                        } else
                        //return " Failed";
                            return false;
                    } else
                    //return " Image file size max 1 MB";                    
                        return false;
                } else
                //return " Invalid file format..";                
                    return false;
            } else
            //return" Please select image..!";            
                return false;
        }else {
            //return 'No file Attached';
            return false;
        }
    }

    function updateAcc($uname, $type, $updateVal) {
        $IsInserted = 1;
        $this->db->trans_begin();

        if ($type == 'delete') {
            //$updateArr = array('deleted' => $updateVal);
            $this->db->where('username', $uname);
            $this->db->delete('useracc');
        } elseif ($type == 'update') {
            $this->db->where('username', $uname);
            $updateArr = array('active' => $updateVal);
            $this->db->update('useracc', $updateArr);
        }


        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    //UPDATE PASSWORD ONLY
    function updateAccPass($data) {
        $dataSet = $data['post']['user'];
        $saveas = $dataSet['saveas'];
        $data['sess'] = $sess = $this->session->userdata('User');
        $uname = $sess['username'];
        if ($saveas != 'new') {//update pass request
            $values = array(
                'username' => $uname,
                'oldpass' => $dataSet['oldpass'],
                'pass' => $dataSet['pass'],
                'repass' => $dataSet['repass']
            );
            if ($this->validateUserBeforeAdd($uname)) {
                if ($this->updatePassRequest($values)) {
                    header('Location:' . base_url('index.php/users/updatePassAcc/ok'));
                } else {
                    header('Location:' . base_url('index.php/users/updatePassAcc/fail'));
                }
            } else {
                header('Location:' . base_url('index.php/users/updatePassAcc/fail'));
            }
        }
    }

    public function validateUserBeforeAdd($Uname) {
        $this->db->where('username', $Uname);
        //$this->db->where('active', 1);
        //$this->db->where('deleted', 0);
        //$this->db->where('suspend', 0);
        $this->db->from('useracc');
        $queryCount = $this->db->count_all_results();
        if ($queryCount === 1) {//ok mail found
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //SIGNUP- ADD NEW STAFF USER
    function saveRequest($values, $role) {

        if (!(isset($values['usertype']) && isset($values['pass']) && isset($values['repass']) && isset($values['email']) && isset($values['username']) && isset($values['profname']) && isset($values['mobile']))) {
            //echo $msg ="<br> Please Fill All Required Fields"; echo 'a';
            return false;
        } else {
            $validemail = $this->check_Email_Address($values['email']);

            if ($validemail) {
                //good email
                if ($values['pass'] == $values['repass']) {
                    //pass match
                    $passvalidator = new setuplockpbkdf2MODEL();
                    $passcode = $passvalidator->create_hash($values['pass']);
                    $hash = md5(rand(3474747, 99995259));
                    $hash = $passvalidator->create_hash($hash . $values['username'] . $hash);

                    $propic = 'noname.jpg';
                    $mob = '';
                    $res = '';
                    $off = '';
                    if (!isset($values['profilepic'])) {
                        $propic = 'noname.jpg';
                    } else {
                        $propic = strip_tags($values['profilepic']);
                    }

                    if (!isset($values['mobile'])) {
                        $mob = '-';
                    } else {
                        $mob = strip_tags($values['mobile']);
                    }
                    if (!isset($values['res_mobile'])) {
                        $res = '-';
                    } else {
                        $res = strip_tags($values['res_mobile']);
                    }
                    if (!isset($values['off_mobile'])) {
                        $off = '-';
                    } else {
                        $off = strip_tags($values['off_mobile']);
                    }
                    if (!isset($values['username'])) {
                        $uname = '';
                    } else {
                        $uname = strip_tags($values['username']);
                    }

                    $cusid = 0;
                    if (!isset($values['customer_id'])) {
                        $cusid = 0;
                    } else {
                        $cusid = $values['customer_id'];
                    }

                    $this->db->trans_begin();
                    $IsInsert = array(
                        'passcode' => $passcode,
                        'username' => $uname,
                        'role' => $role,
                        'cus_id' => $cusid,
                        'postas' => $values['usertype'],
                        'email' => $values['email'],
                        'mobile' => $mob,
                        'res_mobile' => $res,
                        'off_mobile' => $off,
                        'profilepic' => $propic,
                        'profname' => $values['profname'],
                        'active' => 1,
                        'deleted' => 0,
                        'hash' => $hash,
                        'resetpw' => 0,
                        'departmentID' => $values['departmentID'],
                        'grade_id' => $values['grade_id']
                    );
                    $this->db->insert('useracc', $IsInsert);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                        $this->db->trans_rollback();
                    } else {
                        $IsInserted = 1;
                        $this->db->trans_commit();
                    }



                    if ($IsInserted == 1) {
//                        $to = $values['email'];
//                        $to2 = ADMINMAIL;
//                        $subject = 'Signup | Membership Request- Online Pola'; // Give the email a subject
//                        $emailcontent = $this->emailBody($values['uname'], $hash, $values['email']);
//                        $headers = 'MIME-Version: 1.0' . "\r\n";
//                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//                        $mail = new PHPMailer();
//                        //$mail->IsSMTP();                   // set mailer to use SMTP
//                        $mail->Host = "webmail.setup.lk";  // specify main and backup server
//                        //$mail->SMTPAuth = true;     // turn on SMTP authentication
//                        $mail->Username = "info@setup.lk";  // SMTP username
//                        $mail->Password = "sevento7"; // SMTP password
//
//                        $mail->From = "info@setup.lk";
//                        $mail->FromName = "Online Pola Support Team";
//                        $mail->AddAddress($to);                  // name is optional
//                        $mail->IsHTML(true);                                  // set email format to HTML
//                        $mail->Subject = $subject;
//                        $mail->Body = $emailcontent;
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

                        if (FALSE/* !$mail->Send() */) {
                            return FALSE;
                        } else {
                            return TRUE;
                        }
                    } else {
                        return FALSE;
                    }
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    function updateRequest($values, $role) {

        if (!(isset($values['usertype']) && isset($values['pass']) && isset($values['repass']) && isset($values['email']) && isset($values['username']) && isset($values['profname']) && isset($values['mobile']))) {
            //echo $msg ="<br> Please Fill All Required Fields"; echo 'a';
            return false;
        } else {
            $validemail = $this->check_Email_Address($values['email']);

            if ($validemail) {
                //good email
                if ($values['pass'] == '' && $values['repass'] == '') {//update without password
                    $propic = 'noname.jpg';
                    $mob = '';
                    $res = '';
                    $off = '';
                    if (!isset($values['profilepic'])) {
                        $propic = 'noname.jpg';
                    } else {
                        $propic = strip_tags($values['profilepic']);
                    }

                    if (!isset($values['mobile'])) {
                        $mob = '-';
                    } else {
                        $mob = strip_tags($values['mobile']);
                    }
                    if (!isset($values['res_mobile'])) {
                        $res = '-';
                    } else {
                        $res = strip_tags($values['res_mobile']);
                    }
                    if (!isset($values['off_mobile'])) {
                        $off = '-';
                    } else {
                        $off = strip_tags($values['off_mobile']);
                    }
                    if (!isset($values['username'])) {
                        $uname = '';
                    } else {
                        $uname = strip_tags($values['username']);
                    }


                    $act = $values['isact'];

                    $cusid = 0;
                    if (!isset($values['customer_id'])) {
                        $cusid = 0;
                    } else {
                        $cusid = $values['customer_id'];
                    }

                    $this->db->trans_begin();
                    $IsInsert = array(
                        'role' => $role,
                        'postas' => $values['usertype'],
                        'email' => $values['email'],
                        'mobile' => $mob,
                        'cus_id' => $cusid,
                        'res_mobile' => $res,
                        'off_mobile' => $off,
                        'profilepic' => $propic,
                        'profname' => $values['profname'],
                        'active' => $act,
                        'deleted' => 0,
                        'resetpw' => 0,
                        'departmentID' => $values['departmentID'],
                        'grade_id' => $values['grade_id']
                    );
                    $this->db->where('username', $uname);
                    $this->db->update('useracc', $IsInsert);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                        $this->db->trans_rollback();
                    } else {
                        $IsInserted = 1;
                        $this->db->trans_commit();
                    }



                    if ($IsInserted == 1) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } elseif ($values['pass'] == $values['repass']) {
                    //pass match
                    $passvalidator = new setuplockpbkdf2MODEL();
                    $passcode = $passvalidator->create_hash($values['pass']);
                    $hash = md5(rand(3474747, 99995259));
                    $hash = $passvalidator->create_hash($hash . $values['username'] . $hash);

                    $propic = 'noname.jpg';
                    $mob = '';
                    $res = '';
                    $off = '';
                    if (!isset($values['profilepic'])) {
                        $propic = 'noname.jpg';
                    } else {
                        $propic = strip_tags($values['profilepic']);
                    }

                    if (!isset($values['mobile'])) {
                        $mob = '-';
                    } else {
                        $mob = strip_tags($values['mobile']);
                    }
                    if (!isset($values['res_mobile'])) {
                        $res = '-';
                    } else {
                        $res = strip_tags($values['res_mobile']);
                    }
                    if (!isset($values['off_mobile'])) {
                        $off = '-';
                    } else {
                        $off = strip_tags($values['off_mobile']);
                    }
                    if (!isset($values['username'])) {
                        $uname = '';
                    } else {
                        $uname = strip_tags($values['username']);
                    }


                    $act = $values['isact'];

                    $cusid = 0;
                    if (!isset($values['customer_id'])) {
                        $cusid = 0;
                    } else {
                        $cusid = $values['customer_id'];
                    }


                    $this->db->trans_begin();
                    $IsInsert = array(
                        'passcode' => $passcode,
                        'role' => $role,
                        'cus_id' => $cusid,
                        'postas' => $values['usertype'],
                        'email' => $values['email'],
                        'mobile' => $mob,
                        'res_mobile' => $res,
                        'off_mobile' => $off,
                        'profilepic' => $propic,
                        'profname' => $values['profname'],
                        'active' => $act,
                        'deleted' => 0,
                        'hash' => $hash,
                        'resetpw' => 0,
                        'departmentID' => $values['departmentID']
                    );
                    $this->db->where('username', $uname);
                    $this->db->update('useracc', $IsInsert);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                        $this->db->trans_rollback();
                    } else {
                        $IsInserted = 1;
                        $this->db->trans_commit();
                    }



                    if ($IsInserted == 1) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    function check_Email_Address($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

    
    //SAVE USER REAL PROFILE DETAILS
    function createAccProfile($data) {
        $IsInserted = 0;
        $data = $data['post']['user'];
        $username = $data['uname'];
        $actual_name = $data['actual_name'];
        $date_join = $data['date_join'];
        $date_resign='0000-00-00';
        if(!empty($data['date_resign']) && isset($data['date_resign'])){
            $date_resign = $data['date_resign'];
        }
        $save = $data['saveas']; 
        $active = 0;
        if (!empty($data['active']) && isset($data['active'])) {
            $active = $data['active'];
        }
        $arrIn = array(
            '`username`' => $username,
            '`name`' => $actual_name,
            '`date_join`' => $date_join,
            '`date_resign`' => $date_resign,
            '`isact`' => $active
        );
        //print_r($arrIn);        
        if ($save=='new' && !$this->validateUserProfileBeforeAdd($username, $date_join, $date_resign)) {
            $this->db->trans_begin();
            $this->db->insert('`useracc_profile`', $arrIn);
            //$this->db->last_query();
            if ($this->db->trans_status() === FALSE) { 
                $this->db->trans_rollback();
            } else {
                $IsInserted = 1;
                $this->db->trans_commit();
            }
        }elseif($save!=='new') {
            $this->db->trans_begin();
            $this->db->where('id',$save);
            $this->db->update('`useracc_profile`', $arrIn);
            if ($this->db->trans_status() === FALSE) { 
                $this->db->trans_rollback();
            } else {
                $IsInserted = 1;
                $this->db->trans_commit();
            }
        }
        return $IsInserted;
    }
    public function validateUserProfileBeforeAdd($username, $date_join, $date_resign) {
        $this->db->where('username', $username);
        $this->db->where('date_join', $date_join);
        $this->db->where('date_resign', $date_resign);
        //$this->db->where('active', 1);
        $this->db->from('useracc_profile');
        $queryCount = $this->db->count_all_results();
        if ($queryCount >= 1) {//ok mail found
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function getProfiledata($id=null,$username=null){
        $this->db->select('`id`, `username`, `name`, `date_join`, `date_resign`, `isact`');
        $this->db->from('`useracc_profile`');
        if(!empty($id) && isset($id)){
            $this->db->where('id',$id); 
        }
        if(!empty($username) && isset($username)){
            $this->db->where('username',$username);
        }
        $query=$this->db->get();
        if(!empty($id) && isset($id)){ 
            $result=$query->row();
        }else{
            $result=$query->result_array();
        }
        return $result;
    }
    //UPDATE PASSWORD REQUEST
    function updatePassRequest($values) {
        $IsInserted = 0;
        if (!(isset($values['pass']) && isset($values['repass']) && isset($values['username']))) {
            return false;
        } else {
            if ($values['pass'] == '' && $values['repass'] == '') {//update without password
                return false;
            } elseif ($values['pass'] == $values['repass'] && $this->validateOldPass($values['username'], $values['oldpass'])) {
                //pass match
                $passvalidator = new setuplockpbkdf2MODEL();
                $passcode = $passvalidator->create_hash($values['pass']);
                $hash = md5(rand(3474747, 99995259));
                $hash = $passvalidator->create_hash($hash . $values['username'] . $hash);

                if (!isset($values['username'])) {
                    $uname = '';
                } else {
                    $uname = strip_tags($values['username']);
                }

                $this->db->trans_begin();
                $IsInsert = array(
                    'passcode' => $passcode,
                    'resetpw' => 0
                );
                $this->db->where('username', $uname);
                $this->db->update('useracc', $IsInsert);
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
                if ($IsInserted == 1) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    //validate user against old password before new pass update
    function validateOldPass($user, $pw) {
        $loginData = array(
            'username' => $user,
            'active' => 1,
            'deleted' => 0,
            'resetpw' => 0,
            'suspend' => 0
        );

        $this->db->from('useracc');
        $this->db->join('user_type', 'useracc.role=user_type.id', 'left');
        $this->db->where($loginData);
        $query = $this->db->get();
        $count = $query->num_rows(); //$sth->rowCount();
        $result = $query->result_array();
        if ($count === 1) {//userfound            
            foreach ($result as $row) {
                $rowPw = $row['passcode'];
                $rowName = $row['profname'];
                $rowUName = $row['username'];
                $rowRole = $row['role'];
                $rowCusID = $row['cus_id'];
                $roleName = $row['name'];
                $rowPic = $row['profilepic'];
                $rowUID = $row['email'];
                $roleSince = $row['createddate'];
            }
            $passvalidator = new setuplockpbkdf2MODEL();
            if ($this->assert_true($passvalidator->validate_password($pw, $rowPw)) === 'pass') {//old password match
                return TRUE;
            } else {
                return false;
            }
        } else {//no user found
            return false;
        }
        $this->db->close();
    }

    //GET USERS LIST OF STAFF
    function getUserList($role = NULL, $isact = NULL, $uname = null, $grade_id = null) {
        $this->db->select('email,username,role,useracc.grade_id,profname,profilepic,cus_id, user_type.name, mobile,active,departmentID,ic_locations_department.name AS depName');
        $this->db->from('useracc');
        $this->db->join('user_type', 'user_type.id=useracc.role', 'left');
        $this->db->join('ic_locations_department', 'useracc.departmentID=ic_locations_department.id', 'left');
        $this->db->join('company_organization_structure', 'useracc.grade_id=company_organization_structure.grade_id', 'left');

        if (!empty($role) && isset($role) && !is_null($role)) {
            $this->db->where('useracc.role', $role);
        }
        if (!empty($isact) && isset($isact) && !is_null($isact)) {
            $this->db->where('useracc.active', $isact);
        }
        if (!empty($uname) && isset($uname) && !is_null($uname)) {
            $this->db->where('useracc.username', $uname);
        }
        if (!empty($grade_id) && isset($grade_id) && !is_null($grade_id)) {
            $this->db->where('useracc.grade_id', $grade_id);
        }

        $this->db->where('useracc.deleted', 0);

        $query = $this->db->get();
        if (!empty($uname) && isset($uname) && !is_null($uname)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }

        return $result;
    }

    //ALLOW ACCESS TO CONTOLLER FUNCTIONS
    function authenticateMe($funcid) {
        $sessData = $this->session->userdata('User');
        if (empty($sessData['username']) && !isset($sessData['username'])) {
            $sessData['username'] = 'guest';
        }
        $user = $sessData['username'];
        $fid = $funcid;

        $result = $this->UsersModel->authUserAccess($user, $fid);
        if ($result == 1) {
            return TRUE;
        } else {
            header('Location:' . base_url('index.php/users/authError/'));
            die();
        }
    }

    //ALLOW ACCESS TO CONTOLLER SUB FUNCTIONS
    function authenticateMeSubFunction($funcid, $subFunID) {
        $sessData = $this->session->userdata('User');
        if (empty($sessData['username']) && !isset($sessData['username'])) {
            $sessData['username'] = 'guest';
        }
        $user = $sessData['username'];
        $fid = $funcid;

        $result = $this->UsersModel->authUserAccessSubFunction($user, $funcid, $subFunID);
        if ($result == 1) {
            return TRUE;
        } else {
            header('Location:' . base_url('index.php/users/authError/'));
            die();
        }
    }

    //CHECK MODULE FUNCTION ACCESS STATUS
    function authUserAccess($user, $fid) {
        $this->db->select();
        $this->db->from('user_levels_auth');
        $this->db->join('user_group_module_function', 'user_levels_auth.group_id=user_group_module_function.user_group_id', 'left');
        $this->db->join('app_module_function', 'user_group_module_function.module_function_id=app_module_function.id', 'left');
        $this->db->where(array('user_levels_auth.user_id' => $user, 'app_module_function.id' => $fid, 'user_levels_auth.isact' => 1, 'app_module_function.isact' => 1));
        $query = $this->db->get();

        $rowCount = $query->num_rows();
        if ($rowCount == 1) {
            return 1;
        } else {
            return -5;
        }
    }

    function authUserAccessSubFunction($user, $fid, $subFID) {
        $this->db->select();
        $this->db->from('user_levels_auth');
        $this->db->join('user_group_module_function', 'user_levels_auth.group_id=user_group_module_function.user_group_id', 'left');
        $this->db->join('user_group_module_function_sub', 'user_group_module_function.user_group_id=user_group_module_function_sub.user_group_id AND user_group_module_function.module_function_id=user_group_module_function_sub.module_function_id', 'left');
        $this->db->join('app_module_function', 'user_group_module_function.module_function_id=app_module_function.id', 'left');
        $this->db->join('app_module_function_sub', 'user_group_module_function_sub.module_function_sub_id=app_module_function_sub.id', 'left');
        $this->db->where(array('user_levels_auth.user_id' => $user, 'app_module_function.id' => $fid, 'app_module_function_sub.id' => $subFID, 'user_levels_auth.isact' => 1, 'app_module_function.isact' => 1));
        $query = $this->db->get();

        $rowCount = $query->num_rows();
        if ($rowCount == 1) {
            return 1;
        } else {
            return -5;
        }
    }

    //ALLOW ACCESS FOR FUNCTIONS AND MENUS
    function userAuth() {
        $this->db->select('user_group.name as display_name,user_group.id as group_id,app_module.name as name');
        $this->db->from('user_group');
        $this->db->join('app_module', 'user_group.module_id=app_module.id', 'left');
        $this->db->where('user_group.isact', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    //GET CURRENT ACCESS ALLOWED LIST
    function userAuthAlreadyGranted($uid) {
        $this->db->select('user_levels_auth.group_id as grpid');
        $this->db->from('user_group');
        $this->db->join('user_levels_auth', 'user_group.id=user_levels_auth.group_id', 'left');
        $this->db->where('user_group.isact', 1);
        $this->db->where('user_levels_auth.user_id', $uid);
        $query = $this->db->get();
        $result = $query->result_array();
        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row['grpid'];
        }

        return $arr;
    }

    //UPDATE PERMISSION FOR USER
    function updateAuthData($data) {
        $authLevel = $data['authCode'];
        $user = $data['userid'];

        $this->db->trans_begin();
        $this->db->where('user_id', $user);
        $this->db->delete('user_levels_auth');

        $arr = array();
        foreach ($authLevel as $row) {
            $arr = array(
                'user_id' => $user,
                'group_id' => $row
            );
            $this->db->insert('user_levels_auth', $arr);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }

        if ($IsInserted == 1) {//Inerted 
            header('Location:' . base_url('index.php/users/allowUserAccess/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/users/allowUserAccess/-1/fail'));
        }
    }

    //UPDATE LOCATION AUTH DATA
    //UPDATE PERMISSION FOR USER
    function updateAuthLocationData($data) {
        $authLevel = $data['authCode'];
        $user = $data['userid'];

        $this->db->trans_begin();
        $this->db->where('user_id', $user);
        $this->db->delete('useracc_ic_location');

        $arr = array();
        foreach ($authLevel as $row) {
            $arr = array(
                'user_id' => $user,
                'location_id' => $row
            );
            $this->db->insert('useracc_ic_location', $arr);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }

        return $IsInserted;
    }

    // save update user group
    function saveAccGroup($data) {
        $IsInserted = 0;
        $grpData = '';
        $gpname = '';
        $gpModule = '';

        $grpData = $data['group'];
        $gpname = $grpData['name'];
        $gpModule = $grpData['module'];

        if (!empty($data['group']) && isset($data['group']) && !empty($grpData['name']) && isset($grpData['name']) && !empty($grpData['module']) && isset($grpData['module'])) {


            if ($grpData['id'] == 'new') {//new entry
                $this->db->trans_begin();
                $arrGrpIn = array(
                    'name' => $gpname,
                    'module_id' => $gpModule
                );
                $this->db->insert('user_group', $arrGrpIn);
                $grpid = $this->db->insert_id();
                foreach ($grpData['auth'] as $fid) {
                    $arrIn = array('module_function_id' => $fid, 'user_group_id' => $grpid);
                    $this->db->insert('user_group_module_function', $arrIn);
                }
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            } else {
                $this->db->trans_begin();
                $arrGrpUp = array(
                    'name' => $gpname,
                );
                $this->db->where('id', $grpData['id']);
                $this->db->update('user_group', $arrGrpUp);

                //delete auth functions
                $arrGrpdel = array('user_group_id' => $grpData['id']);
                $this->db->delete('user_group_module_function', $arrGrpdel);
                //add as new 
                foreach ($grpData['auth'] as $fid) {
                    $arrIn = array('module_function_id' => $fid, 'user_group_id' => $grpData['id']);
                    $this->db->insert('user_group_module_function', $arrIn);
                }
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            }
        }
        return $IsInserted;
    }

    function updateGroupData($uid, $type, $updateVal) {
        $IsInserted = 1;
        $this->db->trans_begin();
        if ($type == 'delete') {
            $updateArr = array('delete' => $updateVal);
        } elseif ($type == 'update') {
            $updateArr = array('isact' => $updateVal);
        }
        $this->db->where('id', $uid);
        $this->db->update('user_group', $updateArr);
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    //SAVE ORGERNIZATION STRUCUTR
    function updateOrgStructureData($data) {
        $IsInserted = 1;
        $GradeName = $data['grade']['name'];
        $display = $data['grade']['display'];
        if ($data['grade']['id'] == 'new') {
            $this->db->trans_begin();
            $this->db->insert('company_organization_structure', array('grade_name' => $GradeName, 'display_order' => $display));
            $id = $this->db->insert_id();
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
            foreach ($data['grade']['reportTo'] as $report) {
                $this->db->insert('company_organization_structure_mapping', array('grade_id' => $id, 'report_to_grade_id' => $report));
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                } else {
                    
                }
            }
        } else {
            $this->db->trans_begin();
            $this->db->where('grade_id', $data['grade']['id']);
            $this->db->update('company_organization_structure', array('grade_name' => $GradeName, 'display_order' => $display));
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
            foreach ($data['grade']['reportTo'] as $report) {
                $this->db->where('grade_id', $data['grade']['id']);
                $this->db->delete('company_organization_structure_mapping');
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                } else {
                    
                }
                $this->db->insert('company_organization_structure_mapping', array('grade_id' => $data['grade']['id'], 'report_to_grade_id' => $report));
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                } else {
                    
                }
            }
        }
        if ($IsInserted == 0) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    //get user Types
    function getUserTypes() {
        $this->db->select('id,name,isact');
        $this->db->from('user_type');
        $this->db->where('isact', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    //Get Allowed Menu for user
    function getMenuList() {
        $sessData = $this->session->userdata('User');
        if (empty($sessData['username']) || !isset($sessData['username'])) {
            $sessData['username'] = 'guest';
        }
        $user = $sessData['username'];
        $result = $this->getMenu($user);
        return $result;
    }

    //GET SUB MENU ICON FOR A MAIN MODULE FUNCTION
    function getMenuSubIconList($fid) {
        $sessData = $this->session->userdata('User');
        if (empty($sessData['username']) || !isset($sessData['username'])) {
            $sessData['username'] = 'guest';
        }
        $user = $sessData['username'];
        $result = $this->getMenuSubIcons($user, $fid);
        return $result;
    }

    function getMenu($user) {
        $this->db->select('app_module_function.module_id,app_module.name AS name,ModuleType,url,app_module_function.display_name,app_module_function.fa_icon as class');
        $this->db->from('user_levels_auth');
        $this->db->join('user_group', 'user_levels_auth.group_id=user_group.id', 'left');
        $this->db->join('user_group_module_function', 'user_group.id=user_group_module_function.user_group_id', 'left');
        $this->db->join('app_module_function', 'user_group_module_function.module_function_id=app_module_function.id', 'left');
        $this->db->join('app_module', 'app_module_function.module_id=app_module.id', 'left');
        $this->db->where(array('user_levels_auth.user_id' => $user, 'user_levels_auth.isact' => 1, 'is_menu_link' => 1));
        $this->db->order_by('app_module.display_order asc,app_module_function.display_order asc');
        $query = $this->db->get();

        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //GET SUB MENU ICONS
    function getMenuSubIcons($user, $fid) {
        $this->db->select('app_module_function_sub.url,app_module_function_sub.display_name,app_module_function_sub.fa_icon as class,app_module_function_sub.comments');
        $this->db->from('user_levels_auth');
        $this->db->join('user_group', 'user_levels_auth.group_id=user_group.id', 'left');
        $this->db->join('user_group_module_function', 'user_group.id=user_group_module_function.user_group_id', 'left');
        $this->db->join('user_group_module_function_sub', 'user_group.id=user_group_module_function_sub.user_group_id AND user_group_module_function.module_function_id=user_group_module_function_sub.module_function_id', 'left');
        $this->db->join('app_module_function_sub', 'user_group_module_function_sub.module_function_sub_id=app_module_function_sub.id', 'left');
        $this->db->join('app_module_function', 'user_group_module_function.module_function_id=app_module_function.id', 'left');
        $this->db->join('app_module', 'app_module_function.module_id=app_module.id', 'left');
        $this->db->where(array('user_levels_auth.user_id' => $user, 'app_module_function.id' => $fid, 'user_levels_auth.isact' => 1, 'app_module_function_sub.is_menu_link' => 1));
        $this->db->order_by('app_module.display_order asc,app_module_function.display_order, app_module_function_sub.display_order asc');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    function getMainModule() {
        $this->db->select('app_module.id,app_module.name,app_module.fa_icon,ModuleType');
        $this->db->from('app_module');
        $this->db->where('app_module.isact', 1);
        $this->db->order_by('app_module.display_order asc');
        $query = $this->db->get();

        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getMainModuleFunctions($mid, $fid = NULL) {
        $this->db->select('app_module_function.id,ModuleType,app_module.name,app_module_function.fa_icon,app_module_function.display_name,comments');
        $this->db->from('app_module');
        $this->db->join('app_module_function', 'app_module.id=app_module_function.module_id');
        $this->db->where('app_module.id', $mid);
        $this->db->where('app_module.isact', 1);
        $this->db->where('app_module_function.isact', 1);
        $this->db->where('app_module_function.is_menu_link', 1);
        $this->db->order_by('app_module_function.display_order asc');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    function getUserGroup($gpid = null) {
        $this->db->select('user_group.id,user_group.name,user_group.isact,app_module.name as modname,app_module.id as modid');
        $this->db->from('user_group');
        $this->db->join('app_module', 'user_group.module_id=app_module.id');
        $this->db->where('user_group.delete', 0);
        if (!empty($gpid) && !is_null($gpid)) {
            $this->db->where('user_group.id', $gpid);
        }
        $this->db->order_by('app_module.display_order asc');
        $query = $this->db->get();

        if (!empty($gpid) && !is_null($gpid)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    function getUserGroupAccessData($gpid) {
        $this->db->select('user_group_module_function.module_function_id');
        $this->db->from('user_group');
        $this->db->join('user_group_module_function', 'user_group.id=user_group_module_function.user_group_id', 'left');
        $this->db->where('user_group.id', $gpid);
        $this->db->where('user_group_module_function.isact', 1);
        $this->db->order_by('user_group.id asc');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    function userAuthAlreadyGrantedLocation($uid) {
        $this->db->select('useracc_ic_location.location_id');
        $this->db->from('useracc_ic_location');
        $this->db->join('ic_locations', 'useracc_ic_location.location_id=ic_locations.id', 'left');
        $this->db->where('useracc_ic_location.user_id', $uid);
        $this->db->where('useracc_ic_location.isact', 1);
        $query = $this->db->get();

        $result = $query->result_array();

        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row['location_id'];
        }

        return $arr;
    }

    function getUsersLocationData($uid = null, $all = null) {
        $sess = $this->session->userdata('User');
        $locationid = $sess['location'];

        $this->db->distinct();
        $this->db->select('useracc.username,useracc.profname,useracc.role');
        $this->db->from('useracc');
        $this->db->join('useracc_ic_location', 'useracc.username=useracc_ic_location.user_id', 'left');
        $this->db->join('ic_locations', 'useracc_ic_location.location_id=ic_locations.id', 'left');
        if (!is_null($uid)) {
            $this->db->where('useracc_ic_location.user_id', $uid);
        }
        if (is_null($all)) {
            $this->db->where('useracc_ic_location.location_id', $locationid);
            $this->db->where('useracc_ic_location.isact', 1);
        }
        $this->db->where('useracc.active', 1);
        $this->db->where('useracc.deleted', 0);
        $this->db->where('useracc.suspend', 0);

        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    function getStructureList($gradeID = null) {
        $this->db->select('grade_id,grade_name,display_order,isact');
        $this->db->from('company_organization_structure');
        $this->db->where('isact', 1);
        if (!empty($gradeID) && isset($gradeID)) {
            $this->db->where('grade_id', $gradeID);
        }
        $this->db->order_by('display_order ASC');
        $query = $this->db->get();
        if (!empty($gradeID) && isset($gradeID)) {
            $res = $query->row();
        } else {
            $res = $query->result_array();
        }

        return $res;
    }

    function getGradeReportToData($gradeID) {
        $this->db->select('grade_id,report_to_grade_id,isact');
        $this->db->from('company_organization_structure_mapping');
        $this->db->where('isact', 1);
        $this->db->where('grade_id', $gradeID);
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

}

?>