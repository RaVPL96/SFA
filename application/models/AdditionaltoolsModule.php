<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

class AdditionaltoolsModule extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//SEND EMAILS
	function deliverSMS($date){
		$result=$this->getSMSLog($date);
		//print_r($result);
		$str='	<table class="table table-hover" style="font-size:12px; border:1px solid #ccc;">
				<thead>
					<tr>
						<th style="padding:5px 5px;border:1px solid #ccc;">Sales Rep</th>
						<th style="padding:5px 5px;border:1px solid #ccc;">Mobile</th>
						<th style="padding:5px 5px;border:1px solid #ccc;">Date</th>
						<th style="padding:5px 5px;border:1px solid #ccc;">Today Incentive</th>
						<th style="padding:5px 5px;border:1px solid #ccc;">Total</th>
						<th style="padding:5px 5px;border:1px solid #ccc;">Working Days</th>
					</tr>
				</thead>
				<tbody>';
				$str2='';
		foreach($result as $r){
			$str2.='<tr>
						<td style="padding:5px 5px;border:1px solid #ccc;">'.$r['salesrep_name'].'</td>
						<td style="padding:5px 5px;border:1px solid #ccc;">'.$r['mobile'].'</td>
						<td style="padding:5px 5px;border:1px solid #ccc;">'.date('Y-m-d',strtotime($r['asatdate'])).'</td>
						<td style="padding:5px 5px;text-align:right;border:1px solid #ccc;">'.$r['today_incentive'].'</td>
						<td style="padding:5px 5px;text-align:right;border:1px solid #ccc;">'.$r['total_incentive'].'</td>
						<td style="padding:5px 5px;text-align:right;border:1px solid #ccc;">'.$r['working_days'].'</td>
					</tr>';
		}			
		$str3 = '</tbody>
				</table>';
		$body=$str.$str2.$str3;
		$body=$this->createEmailBody($body);
		echo $this->doEmailDelivery($body);
	}
	function createEmailBody($table){
		return $message = ''
                . '	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="format-detection" content="telephone=no" /> <!-- disable auto telephone linking in iOS -->
		<title>Message Received Regarding  ' . COMPANY . ' AD!</title>
		<style type="text/css">
			/* RESET STYLES */
			html { background-color:#E1E1E1; margin:0; padding:0; }
			body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, \"Lucida Grande\", sans-serif;}
			table{border-collapse:collapse;}
			table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
			img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
			a {text-decoration:none !important;border-bottom: 1px solid;color:#2fa4e7;}
			.buttonContent a:hover{color:#000; transition:400ms;}
			.emailButton{background-color:#3498DB;}
			.emailButton:hover{background-color:#FF6F2B; transition:400ms;}
                                                          .ii a[href]{/*color:#ffffff;*/color: #fce702;text-decoration: none;}
			h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}

			/* CLIENT-SPECIFIC STYLES */
			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
			#outlook a{padding:0;} /* Force Outlook 2007 and up to provide a "view in browser" message. */
			img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
			body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
			.ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */

			/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

			/* ========== Page Styles ========== */
			h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
			h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
			h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
			h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
			.flexibleImage{height:auto;}
			.linkRemoveBorder{border-bottom:0 !important;}
			table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}

			body, #bodyTable{background-color:#E1E1E1;}
			#emailHeader{background-color:#E1E1E1;}
			#emailBody{background-color:#FFFFFF;}
			#emailFooter{background-color:#E1E1E1;}
			.nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
			.emailButton{background-color:#205478; border-collapse:separate;}
			.buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
			.buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
			.emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
			.emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
			.emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
			.imageContentText {margin-top: 10px;line-height:0;}
			.imageContentText a {line-height:0;}
			#invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */

			/*FRAMEWORK HACKS & OVERRIDES */
			span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
			span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
			span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
			
			.a[href^="tel"], a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}


			/* MOBILE STYLES */
			@media only screen and (max-width: 480px){
				/*////// CLIENT-SPECIFIC STYLES //////*/
				body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

				/* FRAMEWORK STYLES */
				/*
				CSS selectors are written in attribute
				selector format to prevent Yahoo Mail
				from rendering media query styles on
				desktop.
				*/
				/*td[class="textContent"], td[class="flexibleContainerCell"] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
				table[id="emailHeader"],
				table[id="emailBody"],
				table[id="emailFooter"],
				table[class="flexibleContainer"],
				td[class="flexibleContainerCell"] {width:100% !important;}
				td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
				
				td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important; }
				img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
				img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}


				/*
				Create top space for every second element in a block
				*/
				table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}

				/*
				Make buttons in the email span the
				full width of their container, allowing
				for left- or right-handed ease of use.
				*/
				table[class="emailButton"]{width:100% !important;}
				td[class="buttonContent"]{padding:0 !important;}
				td[class="buttonContent"] a{padding:15px !important;}

			}

			/*  CONDITIONS FOR ANDROID DEVICES ONLY
			*   http://developer.android.com/guide/webapps/targeting.html
			*   http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/ ;
			=====================================================*/

			@media only screen and (-webkit-device-pixel-ratio:.75){
				/* Put CSS for low density (ldpi) Android layouts in here */
			}

			@media only screen and (-webkit-device-pixel-ratio:1){
				/* Put CSS for medium density (mdpi) Android layouts in here */
			}

			@media only screen and (-webkit-device-pixel-ratio:1.5){
				/* Put CSS for high density (hdpi) Android layouts in here */
			}
			/* end Android targeting */

			/* CONDITIONS FOR IOS DEVICES ONLY
			=====================================================*/
			@media only screen and (min-device-width : 320px) and (max-device-width:568px) {

			}
			/* end IOS targeting */
		</style>
		<!--
			Outlook Conditional CSS

			These two style blocks target Outlook 2007 & 2010 specifically, forcing
			columns into a single vertical stack as on mobile clients. This is
			primarily done to avoid the page break bug and is optional.

			More information here:
			http://templates.mailchimp.com/development/css/outlook-conditional-css
		-->
		<!--[if mso 12]>
			<style type="text/css">
				.flexibleContainer{display:block !important; width:100% !important;}
			</style>
		<![endif]-->
		<!--[if mso 14]>
			<style type="text/css">
				.flexibleContainer{display:block !important; width:100% !important;}
			</style>
		<![endif]-->
	</head>
	<body bgcolor="#E1E1E1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

		<!-- CENTER THE EMAIL // -->
		<!--
		1.  The center tag should normally put all the
			content in the middle of the email page.
			I added "table-layout: fixed;" style to force
			yahoomail which by default put the content left.

		2.  For hotmail and yahoomail, the contents of
			the email starts from this center, so we try to
			apply necessary styling e.g. background-color.
		-->
		<center style="background-color:#E1E1E1;">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
				<tr>
					<td align="center" valign="top" id="bodyCell">

						<!-- EMAIL HEADER // -->
						<!--
							The table "emailBody" is the emails container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->
						<table bgcolor="#E1E1E1" border="0" cellpadding="0" cellspacing="0" width="500" id="emailHeader">

							<!-- HEADER ROW // -->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="10" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td valign="top" width="500" class="flexibleContainerCell">

															<!-- CONTENT TABLE // -->
															<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<!--
																		The "invisibleIntroduction" is the text used for short preview
																		of the email before the user opens it (50 characters max). Sometimes,
																		you do not want to show this message depending on your design but this
																		text is highly recommended.

																		You do not have to worry if it is hidden, the next <td> will automatically
																		center and apply to the width 100% and also shrink to 50% if the first <td>
																		is visible.
																	-->
																	<td align="left" valign="middle" id="invisibleIntroduction" class="flexibleContainerBox" style="display:none !important; mso-hide:all;">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;">
																			<tr>
																				<td align="left" class="textContent">
																					<div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
																						Merchandising Incentive Report Sent by MIS Division
																					</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																	<td align="right" valign="middle" class="flexibleContainerBox">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;">
																			<tr>
																				<td align="left" class="textContent">
																					<!-- CONTENT // -->
																					<div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
																						<!--If you cant see this message, <a href="#" target="_blank" style="text-decoration:none;border-bottom:1px solid #828282;color:#828282;"><span style="color:#828282;">view&nbsp;it&nbsp;in&nbsp;your&nbsp;browser</span></a>.-->
																					</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // END -->

						</table>
						<!-- // END -->

						<!-- EMAIL BODY // -->
						<!--
							The table "emailBody" is the emails container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->
						<table bgcolor="#FFFFFF"  border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">

							<!-- MODULE ROW // -->
							<!--
								To move or duplicate any of the design patterns
								in this email, simply move or copy the entire
								MODULE ROW section for each content block.
							-->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<!--
										The centering table keeps the content
										tables centered in the emailBody table,
										in case its width is set to 100%.
									-->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;" bgcolor="#393939">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<!--
													The flexible container has a set width
													that gets overridden by the media query.
													Most content tables within can then be
													given 100% widths.
												-->
												<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td align="center" valign="top" width="500" class="flexibleContainerCell">

															<!-- CONTENT TABLE // -->
															<!--
															The content table is the first element
																thats entirely separate from the structural
																framework of the email.
															-->
															<table border="0" cellpadding="30" cellspacing="0" width="100%">
																<tr>
																	<td align="center" valign="top" class="textContent">
																		<img src="' . base_url('adminlte/dist/img/logo.png') . '" alt="' . COMPANY . ' - Daily Merchandising Incentive Report" style="width:100px">
																		<h6 style="text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#ffffff;line-height:1.7em;margin-top: 5px;">Merchandising Photo Incentive Report</h6>
																		<div style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:1.7em;margin-top: 5px;">MIS Team sent a Message Regarding Merchandising Photo Incentive. <br/>Please Check the Message Details Below</div>
																	</td>
																</tr>
															</table>
															<!-- // CONTENT TABLE -->

														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->

							
							<!-- MODULE ROW // -->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="0" cellspacing="0" width="700" class="flexibleContainer">
													<tr>
														<td align="center" valign="top" width="700" class="flexibleContainerCell">
															<table border="0" cellpadding="30" cellspacing="0" width="100%">
																<tr>
																	<td align="center" valign="top">

																		<!-- CONTENT TABLE // -->
																		<table border="0" cellpadding="0" cellspacing="0" width="100%">
																			<tr>
																				<td valign="top" class="textContent">
																					<!--
																						The "mc:edit" is a feature for MailChimp which allows
																						you to edit certain row. It makes it easy for you to quickly edit row sections.
																						http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
																					-->
																					<h3 mc:edit="header" style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Merchandising Photo Incentive Report</h3>
																					
																				</td>
																			</tr>
                                                                                                                                                                                                                                                                                                                                                                             <tr>
                                                                                                                                                                                                                                                                                                                                                                             <td style="font-size:12px;"> ' . $table . '</td>
                                                                                                                                                                                                                                                                                                                                                                             </tr>   
                                                                                                                                                                                                                                                                                                                                                                                          
																		</table>
																		<!-- // CONTENT TABLE -->

																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->
							

						
							<!-- MODULE ROW // -->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td valign="top" width="500" class="flexibleContainerCell">

															<!-- CONTENT TABLE // -->
															<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td align="left" valign="top" class="flexibleContainerBox" style="background-color:#5F5F5F;">
																		<table border="0" cellpadding="30" cellspacing="0" width="100%" style="max-width:100%;">
																			<tr>
																				<td align="left" class="textContent">
																					<h3 style="color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">' . COMPANY . '</h3>
																					<div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">Koswatta,<br/>Kiriwaththuduwa<br/>Homagama.</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																	<td align="right" valign="top" class="flexibleContainerBox" style="background-color:#27ae60;">
																		<table class="flexibleContainerBoxNext" border="0" cellpadding="30" cellspacing="0" width="100%" style="max-width:100%;">
																			<tr>
																				<td align="left" class="textContent">
																					<h4 style="color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Reach Us</h4>
																					<div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">Tel: <a href="tel: 0000000">+9400000000</a><br/>Web: <a target="_blank" href="http://www.myoffers.lk">MyOffers.lk</a></div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
															<!-- // CONTENT TABLE -->

														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->


							<!-- MODULE ROW // -->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td align="center" valign="top" width="500" class="flexibleContainerCell">
															<table border="0" cellpadding="30" cellspacing="0" width="100%">
																<tr>
																	<td align="center" valign="top">

																		<!-- CONTENT TABLE // -->
																		<table border="0" cellpadding="0" cellspacing="0" width="100%">
																			<tr>
																				<td valign="top" class="textContent">
																					<div style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;margin-top:3px;color:#5F5F5F;line-height:135%;">By activating your account with us you are agreed to comply with our terms and conditions.</div>
																				</td>
																			</tr>
																		</table>
																		<!-- // CONTENT TABLE -->

																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->

						</table>
						<!-- // END -->

						<!-- EMAIL FOOTER // -->
						<!--
							The table "emailBody" is the emails container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->
						<table bgcolor="#E1E1E1" border="0" cellpadding="0" cellspacing="0" width="500" id="emailFooter">

							<!-- FOOTER ROW // -->
							<!--
								To move or duplicate any of the design patterns
								in this email, simply move or copy the entire
								MODULE ROW section for each content block.
							-->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td align="center" valign="top" width="500" class="flexibleContainerCell">
															<table border="0" cellpadding="30" cellspacing="0" width="100%">
																<tr>
																	<td valign="top" bgcolor="#E1E1E1">

																		<div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
																			<div>Copyright &#169; ' . date('Y') . ' <a href="http://www.myoffers.lk" target="_blank" style="text-decoration:none;color:#828282;"><span style="color:#828282;">Developed by Lakshitha Pradeep(MIS Division)</span></a>. All&nbsp;rights&nbsp;reserved.</div>
																			<div>If you do not want to recieve emails from us, you can <a href="#" target="_blank" style="text-decoration:none;color:#828282;"><span style="color:#828282;">unsubscribe</span></a>.</div>
																		</div>

																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>

						</table>
						<!-- // END -->

					</td>
				</tr>
			</table>
		</center>
	</body>
</html>
';
	}
	
	function doEmailDelivery($body){
		$subject = 'Merchandising Photo Incentive'; // Give the email a subject
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $mail = new PHPMailer();
        $mail->IsSMTP();                   // set mailer to use SMTP
        $mail->Host = 'webmail.raigam.lk';  // specify main and backup server
        $mail->SMTPAuth = TRUE;     // turn on SMTP authentication
        $mail->Username = 'lakshitha@raigam.lk';  // SMTP username
        $mail->Password = 'lak@123'; // SMTP password
        //$mail->SMTPSecure = 'tsl';
        $mail->Port = 25; 
        $mail->From = 'lakshitha@raigam.lk';
        $mail->FromName = 'Merchandisings Division- Photo Incentive';
        $mail->AddAddress('lakshitha@raigam.lk');                  // name is optional
        //if ($msgData['copy_mail'] == '1') {
        //    $mail->AddBCC($toCopy);
        //}
        //Add all email copy to admin
        $mail->AddBCC('lakshitha@raigam.lk');
        $mail->AddBCC('prasad@raigam.lk');
		$mail->AddBCC('rohane@raigam.lk');
		$mail->AddBCC('mmu@raigam.lk');
        $mail->IsHTML(true);
        //$mail->SMTPDebug  = 2;// set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
            //die();
            return FALSE;
        } else {
            return TRUE;
        }
	}
	
	function getSMSLog($date){
		//echo date('Y-m-d H:i:s',strtotime($date));die();
		$this->db->select('`id`, `transaction_log_id`, `territory_id`, `salesrep_name`, `mobile`, `asatdate`, `today_incentive`, `total_incentive`, `working_days`');
		$this->db->from('`sales_operations_sms_log`');
		$this->db->where('`asatdate`',date('Y-m-d H:i:s',strtotime($date)));
		$this->db->order_by('`transaction_log_id`,`id` ASC');
		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}
	function saveSMSList($data){
		$data=$data['sms'];
		$id=$data['campaign_id'];
		$name=$data['name'];
		$SalesOpid=$data['sop_id'];
		if(!empty($data['isact']) && isset($data['isact'])){
			$isact=$data['isact'];
		}else{
			$isact=0;
		}
		if(!empty($data['isdel']) && isset($data['isdel'])){
			$isdel=$data['isdel'];
		}else{
			$isdel=0;
		}
		$IsInserted=1;
		$this->db->select('sales_operation_id');
		$this->db->from('sales_operations_sms_h');
		$this->db->where(array('id'=>$$id));
		$query = $this->db->get();
        $count = $query->num_rows();
		
		//if($count === 0){
			//return 0;
		//}else{
			if($id=='new'){
				$arr=array(
					'`name`'=>$name,
					'`sales_operation_id`'=>$SalesOpid,
					'`isact`'=>$isact,
					'`isdel`'=>$isdel
				);
				$this->db->trans_begin();
				$this->db->insert('sales_operations_sms_h',$arr);
				$campID=$this->db->insert_id();
				if ($this->db->trans_status() === FALSE) {
					$IsInserted = 0;
				}				
				//INSERT MESSAGE SNEDERS LIST
				for($i=0;$i<count($data['repnames']); $i++){
					$arrSMS=array(
						'campaign_id'=>$campID,
						'username'=>$data['repnames'][$i]
					);
					$this->db->insert('sales_operations_sms_d',$arrSMS);
					if ($this->db->trans_status() === FALSE) {
						$IsInserted = 0;
					}
				}
				
				if ($IsInserted == 1) {
					$this->db->trans_commit();
					return 1;
				} else {
					$this->db->trans_rollback();
					return 0;
				}
				
			}else{
				$arr=array(
					'`name`'=>$name,					
					'`isact`'=>$isact,
					'`isdel`'=>$isdel
				);
				$this->db->trans_begin();
				$this->db->where(array('`id`'=>$id));
				$this->db->update('sales_operations_sms_h',$arr);
				$campID=$id;
				if ($this->db->trans_status() === FALSE) {
					$IsInserted = 0;
				}
				//INSERT MESSAGE SNEDERS LIST
				$this->db->where(array('id'=>$campID));
				$this->db->delete('sales_operations_sms_d');
				if ($this->db->trans_status() === FALSE) {
					$IsInserted = 0;
				}
				for($i=0;$i<count($data['repnames']); $i++){
					$arrSMS=array(
						'campaign_id'=>$campID,
						'username'=>$data['repnames'][$i]
					);
					$this->db->insert('sales_operations_sms_d',$arrSMS);
					if ($this->db->trans_status() === FALSE) {
						$IsInserted = 0;
					}
				}
				if ($IsInserted == 1) {
					$this->db->trans_commit();
					return 1;
				} else {
					$this->db->trans_rollback();
					return 0;
				}
			}
		//}
	}
	//GET SMS LIST
	function getSMSList($id=null){
		$this->db->select('`id`, `name`, `sales_operation_id`, `isact`, `isdel`');
		$this->db->from('`sales_operations_sms_h`');
		$this->db->where('`sales_operations_sms_h`.`isdel`',0);	
		if(!empty($id) && isset($id)){
			$this->db->where('`sales_operations_sms_h`.`id`',$id);	
		}
		$query=$this->db->get();
		if(!empty($id) && isset($id)){
			$result=$query->row();
		}else{
			$result=$query->result_array();			
		}
		return $result;
	}
	//GET SMS SENDER FOR CAMPAIGNS
	function getOperationAreaTerritorySalesRepSMS($id=null,$opid=null){
		$this->db->select('`useracc`.`profname`,`useracc`.`mobile`,`sales_operations_area_territory_rep`.`rep_username`,`sales_operations_area_territory_rep`.`id`,`sales_operations_area_territory_rep`.`territory_id`, `sales_operations_area_territory`.`name`, `sales_operations_area_territory`.`sales_operation_id`, `sales_operations_area_territory`.`sales_operation_area_id`, `sales_operations_area_territory_rep`.`isact`, `sales_operations_area_territory_rep`.`isdel`,`sales_operations_area`.`id` AS `sopa_id`, `sales_operations_area`.`name` AS `sopa_name`, `sales_operations_area`.`sales_operation_id` AS `sopa_sales_operation_id`, `sales_operations_area`.`isact` AS `sopa_isact`, `sales_operations_area`.`isdel` AS `soap_isdel`,`sales_operations`.`id` AS `op_id`, `sales_operations`.`name` AS `op_name`, `sales_operations`.`isact` AS `op_isact`, `sales_operations`.`isdel` AS `op_isdel`');
		$this->db->from('`sales_operations_sms_h`');
		$this->db->join('`sales_operations_sms_d`','sales_operations_sms_h.id=sales_operations_sms_d.campaign_id','LEFT');
		$this->db->join('`sales_operations_area_territory_rep`','sales_operations_sms_d.username=sales_operations_area_territory_rep.rep_username','LEFT');
		$this->db->join('`useracc`','`sales_operations_area_territory_rep`.`rep_username`=`useracc`.`username`','LEFT');
		$this->db->join('`sales_operations_area_territory`','`sales_operations_area_territory_rep`.`territory_id`=`sales_operations_area_territory`.`id`','LEFT');
		$this->db->join('`sales_operations_area`','`sales_operations_area_territory`.`sales_operation_area_id`=`sales_operations_area`.`id`','LEFT');
		$this->db->join('`sales_operations`','`sales_operations_area`.`sales_operation_id`=`sales_operations`.`id`','LEFT');
		if(!empty($id) && isset($id)){
			$this->db->where('`sales_operations_sms_h`.`id`',$id);	
		}
		if(!empty($opid) && isset($opid)){
			$this->db->where('`sales_operations`.`id`',$opid);	
		}
		//if(!empty($opAreaID) && isset($opAreaID)){
		//	$this->db->where('`sales_operations_area`.`id`',$opAreaID);	
		//	$this->db->where('`sales_operations_area`.`id`',$opAreaID);	
		//}
		$this->db->where('`sales_operations_sms_h`.`isdel`',0);	
		
		$query=$this->db->get();
		$result=$query->result_array();			
		return $result;
	}
}
?>