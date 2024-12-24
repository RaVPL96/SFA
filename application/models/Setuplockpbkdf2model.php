<?php

/*
 * Password hashing with PBKDF2.
 * Author: Lakshitha setup.lk
 * www: http://setup.lk
 */
define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 9977);
define("PBKDF2_SALT_BYTES", 24);
define("PBKDF2_HASH_BYTES", 24);

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);

class setuplockpbkdf2Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create_hash($password) {		/*		$salt ='';
        // format: algorithm:iterations:salt:hash		if (!function_exists('mcrypt_create_iv')) {			$length=11;			$salt = base64_encode( openssl_random_pseudo_bytes($length, NULL));			 		}else{
			$salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));		}		*/				$length=11;
        $salt = base64_encode(openssl_random_pseudo_bytes($length));		return base64_encode('GONERISKSEC' . ":" . "BESTLUCKlankaCode" . ":" . $salt . ":" . base64_encode($this->pbkdf2(PBKDF2_HASH_ALGORITHM, $password, $salt, PBKDF2_ITERATIONS, PBKDF2_HASH_BYTES, true)));
    }

    function validate_password($password, $good_hash) {
        $good_hash=base64_decode($good_hash);
        $params = explode(":", $good_hash);
        if (count($params) < HASH_SECTIONS)            
            return false;
        $pbkdf2 = base64_decode($params[3]);
        return $this->slow_equals(
                        $pbkdf2, $this->pbkdf2(
                                'sha256', $password, $params[2], 9977, strlen($pbkdf2), true
                        )
        );
    }

// Compares two strings $a and $b in length-constant time.
    function slow_equals($a, $b) {
        $diff = strlen($a) ^ strlen($b);
        for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    /*
     * PBKDF2 key derivation function as defined by RSA"s PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
     * $algorithm - The hash algorithm to use. Recommended: SHA256
     * $password - The password.
     * $salt - A salt that is unique to the password.
     * $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
     * $key_length - The length of the derived key in bytes.
     * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
     * Returns: A $key_length-byte key derived from the password and salt.
     *
     * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
     *
     * This implementation of PBKDF2 was originally created by https://defuse.ca
     * With improvements by http://www.variations-of-shadow.com
     */

    function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {
        $algorithm = strtolower($algorithm);
        if (!in_array($algorithm, hash_algos(), true))
            die('PBKDF2 ERROR: Invalid hash algorithm.');
        if ($count <= 0 || $key_length <= 0)
            die('PBKDF2 ERROR: Invalid parameters.');

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for ($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if ($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }

}

?>
