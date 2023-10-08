<?php
session_start();
include("../config/conn.php");

class operations extends database
{

	private $profile_banenr_img, $tmp_profile_banenr_img, $profile_banenr_img_type, $profile_img, $tmp_profile_img, $profile_img_type, $company_img, $tmp_company_img, $company_img_type, $full_name, $email, $mobile, $work_number, $whats_number, $company, $occupation, $address, $bank_details, $gst, $site_link, $self_bio, $address_link, $fb_link, $yt_link, $twitter_link, $ln_link, $insta_link, $otp, $name, $token, $phone, $password, $slug, $isVerified, $status, $id;
	// register admin user function
	public function register_admin($name, $email, $phone, $password)
	{
		$this->name = parent::clean($name);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->password = sha1("sagar" . parent::clean($password) . "maurya");
		// $this->password =  parent::clean($password);

		$check_user = "SELECT * FROM `admin` WHERE `email` = '$this->email' OR `phone` = '$this->phone'";

		if (parent::sql($check_user)) {
			if (parent::numrows() == 0) {
				parent::result();

				$sql = "INSERT INTO `admin` (`name`, `email`, `phone`, `password`) VALUES ('$this->name', '$this->email', '$this->phone', '$this->password')";

				if (parent::sql($sql)) {

					return "Registered Successfully";
				} else {
					return "Failed To Register Please Try Again Later !";
				}
			} else {
				echo "Already Exist !";
			}
		} else {
			return "Server Error, Try Again Later !";
		}
	}

	// login admin function
	public function login_admin($email, $password)
	{
		$this->email = parent::clean($email);
		$this->password = sha1("sagar" . parent::clean($password) . "maurya");
		// $this->password =  parent::clean($password);

		// echo $this->password;
		// die();

		$check_user = "SELECT * FROM `admin` WHERE email = '$this->email'";
		// echo
		// $check_user;
		// die();
		if (parent::sql($check_user)) {
			if (parent::numrows() == 1) {
				$admin_data = parent::result();

				if ($this->password == $admin_data[0]['password']) {

					$_SESSION['admin_id'] = $admin_data[0]['id'];
					$_SESSION['admin_name'] = $admin_data[0]['name'];
					$_SESSION['admin_email'] = $admin_data[0]['email'];
					$_SESSION['admin_phone'] = $admin_data[0]['phone'];

					return "Login Successful";
				} else {
					return "Invalid Password Please Enter Correct Password !";
				}
			} else {
				echo "Seems Like User Does not Exist !";
			}
		} else {
			return "Failed To Login Please Try Again Later !";
		}
	}

	// forgot password function
	public function forgot_password($email, $phone)
	{
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->otp = 1234; //rand(0001, 9999);

		$check_user = "SELECT * FROM `admin` WHERE `email` = '$this->email' AND `phone` = '$this->phone'";

		if (parent::sql($check_user)) {
			if (parent::numrows() == 1) {
				$admin_data = parent::result();

				// $mail = parent::send_email($email, $cc = [], $subject, $message);
				$sms = parent::send_sms($this->phone, "Hello admin, your one time password (OTP) to forget your password is " . $this->otp);

				if ($sms) {

					$_SESSION['token_id'] = $admin_data[0]['id'];
					$_SESSION['token'] = md5($this->otp);

					return "OTP sent successfully";
				} else {
					return "Failed to send OTP, please try again later";
				}
			} else {
				echo "Seems like user does not exist";
			}
		} else {
			return "Failed to send OTP, please try again later";
		}
	}

	// create new password function
	public function create_new_password($password, $otp)
	{
		$this->password = sha1("rajuprasad" . parent::clean($password) . "developer");
		$this->otp = md5(parent::clean($otp));
		$this->id = parent::clean($_SESSION['token_id']);
		$this->token = parent::clean($_SESSION['token']);

		// echo $this->password;
		// die();

		$check_user = "SELECT * FROM `admin` WHERE `id` = '$this->id'";

		if (parent::sql($check_user)) {
			if (parent::numrows() == 1) {
				parent::result();

				if ($this->otp == $this->token) {

					$sql = "UPDATE `admin` SET `password` = '$this->password' WHERE `id` = '$this->id'";

					if (parent::sql($sql)) {

						if (isset($_SESSION['token_id'])) {
							unset($_SESSION['token_id']);
						}

						if (isset($_SESSION['token'])) {
							unset($_SESSION['token']);
						}

						return "Password reset successful";
					} else {
						return "Failed to create new password, please try again later";
					}
				} else {
					echo "Wrong OTP, please enter valid OTP";
				}
			} else {
				echo "Seems like user does not exist";
			}
		} else {
			return "Failed to create new password, please try again later";
		}
	}

	// update admin function
	public function update_admin($name, $email, $phone, $password)
	{
		$this->id = parent::clean($_SESSION['admin_id']);
		$this->name = parent::clean($name);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->password = '';

		if (!empty($password)) {

			$this->password = ", `password` = '" . sha1("sagar" . parent::clean($password) . "maurya") . "'";
		}

		$check_user = "SELECT * FROM `admin` WHERE `id` = '$this->id'";

		if (parent::sql($check_user)) {
			if (parent::numrows() == 1) {
				parent::result();

				$sql = "UPDATE `admin` SET `name` = '$this->name', `email` = '$this->email', `phone` = '$this->phone' $this->password WHERE `id` = '$this->id'";

				if (parent::sql($sql)) {
					$_SESSION['admin_name'] = $this->name;
					$_SESSION['admin_email'] = $this->email;
					$_SESSION['admin_phone'] = $this->phone;

					return "Updated successfully";
				} else {
					return "Failed to update , please try again later";
				}
			} else {
				echo "User doesn't exist !";
			}
		} else {
			return "Server error, try again later !";
		}
	}

	// logout admin function
	public function logout_admin()
	{
		if (session_destroy()) {
			return "Logged out successfully";
		} else {
			return "Failed to logout, please try again later";
		}
	}





	//add Profile
	public function
	add_profile($slug, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $full_name, $email, $mobile, $work_number, $whats_number, $company, $occupation, $address_link, $address, $bank_details, $gst, $site_link, $self_bio, $yt_link, $fb_link, $twitter_link, $ln_link, $insta_link, $color_code)
	{
	$checksql = "SELECT * FROM `user` WHERE `slug` = '$slug'";


		if (parent::sql($checksql)) {
			$datanumrows = parent::numrows();
			$old_file = parent::result();
			if ($datanumrows == 0) {
        		$pass_code =   parent::getPassCode(5);
        		$this->pass_code  = $this->password = sha1("sagar" . parent::clean($pass_code) . "maurya");
        		$this->slug =  $slug;
        		$this->full_name = $full_name;
        		$this->email = $email;
        		$this->mobile = $mobile;
        		$this->address = htmlentities($address);
        		$this->bank_details = htmlentities($bank_details);
        		$this->self_bio = htmlentities($self_bio);
        
        		$this->work_number = $work_number;
        		$this->whats_number = $whats_number;
        		$this->company = $company;
        		$this->occupation = $occupation;
        		$this->gst = $gst;
        		$this->address_link = $address_link;
        		$this->site_link = $site_link;
        		$this->yt_link = $yt_link;
        		$this->fb_link = $fb_link;
        		$this->twitter_link = $twitter_link;
        		$this->ln_link = $ln_link;
        		$this->insta_link = $insta_link;
        
        		$this->isVerified = 1;
        
        		$this->profile_banenr_img = $profile_banenr_img;
        		$this->tmp_profile_banenr_img = $tmp_profile_banenr_img;
        		$this->profile_banenr_img_type = $type_profile_banenr_img;
        
        		$this->profile_img = $profile_img;
        		$this->tmp_profile_img = $tmp_profile_img;
        		$this->profile_img_type = $type_profile_img;
        
        		$this->company_img = $company_img;
        		$this->tmp_company_img = $tmp_company_img;
        		$this->company_img_type = $type_company_img;
        
        		$color_code = '#000';
        
        		$valid_ext = array('png', 'jpeg', 'jpg', 'gif');
        
        		$picture_img_path = "../../assets/profile/picture/";
        		$banner_img_path = "../../assets/profile/banner/";
        		$company_img_path = "../../assets/profile/company/";
        
        
        		// echo $this->profile_banenr_img;
        		$new_profile_banenr_img = '';
        		$new_profile_img = '';
        		$new_company_img = '';
        		if (!empty($this->profile_banenr_img)) {
        			// checking extention validation
        			$file_extension = pathinfo($this->profile_banenr_img, PATHINFO_EXTENSION);
        			$file_extension = strtolower($file_extension);
        
        			// exploding profile pic for renaming
        			$profile_banenr_img_ext = explode(".", $this->profile_banenr_img);
        
        			$new_profile_banenr_img = md5($full_name . $email . date("d-m-Y-h")) . '_profile_banenr_img' . '.' . end($profile_banenr_img_ext);
        			if (in_array($file_extension, $valid_ext)) {
        				parent::compressImage($new_profile_banenr_img, $this->tmp_profile_banenr_img, $this->profile_banenr_img_type, $banner_img_path);
        			}
        		}
        		if (!empty($this->profile_img)) {
        
        			// checking extention validation
        			$file_extension = pathinfo($this->profile_img, PATHINFO_EXTENSION);
        			$file_extension = strtolower($file_extension);
        
        			// exploding profile pic for renaming
        			$profile_img_ext = explode(".", $this->profile_img);
        
        			$new_profile_img = md5($full_name . $email . date("d-m-Y-h")) . '_profile_img' . '.' . end($profile_img_ext);
        			if (in_array($file_extension, $valid_ext)) {
        				parent::compressImage($new_profile_img, $this->tmp_profile_img, $this->profile_img_type, $picture_img_path);
        			}
        		}
        		if (!empty($this->company_img)) {
        
        			// checking extention validation
        			$file_extension = pathinfo($this->company_img, PATHINFO_EXTENSION);
        			$file_extension = strtolower($file_extension);
        
        			// exploding profile pic for renaming
        			$company_img_ext = explode(".", $this->company_img);
        
        			$new_company_img = md5($full_name . $email . date("d-m-Y-h")) . '_company_img' . '.' . end($company_img_ext);
        			if (in_array($file_extension, $valid_ext)) {
        				parent::compressImage($new_company_img, $this->tmp_company_img, $this->company_img_type, $company_img_path);
        			}
        		}
        		// exit;
        		$sql = "INSERT INTO `user`(`pass_code`,`slug`, `banner_img`,`company_img`, `profile_img`, `card_color`, `full_name`, `occupation`, `company`, `self_bio`, `email`, `site_link`, `mobile`, `work_number`, `gst`, `address_link`, `address`, `bank_details`,  `yt_link`, `fb_link`, `ln_link`, `insta_link`, `twitter_link`, `whats_number`,`isVerified`) VALUES ('$this->pass_code','$this->slug','$new_profile_banenr_img ','$new_company_img','$new_profile_img','$color_code','$this->full_name','$this->occupation','$this->company','$this->self_bio','$this->email','$this->site_link','$this->mobile','$this->work_number','$this->gst','$this->address_link','$this->address','$this->bank_details','$this->yt_link','$this->fb_link','$this->ln_link','$this->insta_link','$this->twitter_link','$this->whats_number','$this->isVerified')";
        
        
        		if (parent::sql($sql)) {
        		    
		    // Example usage:
                    $recipient = $this->email;
                    $subject = "Access Your Febble Spot Digital Business Card Profile";  
                    
                    
                    $variables = array();

                    $variables['email'] = $this->email;
                    $variables['code'] = $pass_code;
                    
                    $template = file_get_contents("template.html");

                    foreach($variables as $key => $value)
                    {
                        $template = str_replace('{{'.$key.'}}', $value, $template);
                    }
                    
                    $isSent = parent::sendEmail($recipient, $subject, $template);
                    
                    if ($isSent) {
                         return "Success";
                    } else {
                        return "Email could not be sent to $recipient";
                    }
        		} else {
        			return "Please try again later!";
        		}
			}
			else{
			    $err = "'$slug' this slug is already exists, Please enter unique slug.";
			 	return  $err;
			}
		}
	}
	//add Profile
	public function
	edit_profile($slug, $id, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $full_name, $email, $mobile, $work_number, $whats_number, $company, $occupation, $address_link, $address, $bank_details, $gst, $site_link, $self_bio, $yt_link, $fb_link, $twitter_link, $ln_link, $insta_link, $color_code)
	{

		$checksql = "SELECT * FROM `user` WHERE `id` = '$id'";


		if (parent::sql($checksql)) {
			$datanumrows = parent::numrows();
			$old_file = parent::result();
			if ($datanumrows > 0) {
				$this->id = $id;
				
				
				$checkSlug = "SELECT * FROM `user` WHERE `id` != '$id' AND `slug` = '$slug'";
            	if (parent::sql($checkSlug)) {
            			$datanslugumrows = parent::numrows();
            			$old_file_ = parent::result();
            			if ($datanslugumrows > 0) {
            			    $err = "'$slug' this slug is already exists, Please enter unique slug.";
            			 	return  $err;
            			}
            	    
            	}
            	$this->slug =  $slug;
				$this->full_name = $full_name;
				$this->email = $email;
				$this->mobile = $mobile;
				$this->work_number = $work_number;
				$this->whats_number = $whats_number;
				$this->company = $company;
				$this->occupation = $occupation;
				$this->gst = $gst;
				$this->address = htmlentities($address);
				$this->bank_details = htmlentities($bank_details);
				$this->self_bio = htmlentities($self_bio);
				$this->address_link = $address_link;
				$this->site_link = $site_link;
				$this->fb_link = $fb_link;
				$this->yt_link = $yt_link;
				$this->twitter_link = $twitter_link;
				$this->ln_link = $ln_link;
				$this->insta_link = $insta_link;

				$this->profile_banenr_img = $profile_banenr_img;
				$this->tmp_profile_banenr_img = $tmp_profile_banenr_img;
				$this->profile_banenr_img_type = $type_profile_banenr_img;

				$this->profile_img = $profile_img;
				$this->tmp_profile_img = $tmp_profile_img;
				$this->profile_img_type = $type_profile_img;

				$this->company_img = $company_img;
				$this->tmp_company_img = $tmp_company_img;
				$this->company_img_type = $type_company_img;



				$valid_ext = array('png', 'jpeg', 'jpg', 'gif');

				$picture_img_path = "../../assets/profile/picture/";
				$banner_img_path = "../../assets/profile/banner/";
				$company_img_path = "../../assets/profile/company/";


				// echo $this->profile_banenr_img;
				$profile_banenr_img = '';
				$profile_img = '';
				$$company_img  = '';
				if (!empty($this->profile_banenr_img)) {

					if (!empty($old_file[0]['banner_img'])) {
						@unlink($banner_img_path . $old_file[0]['banner_img']);
					}

					// checking extention validation
					$file_extension = pathinfo($this->profile_banenr_img, PATHINFO_EXTENSION);
					$file_extension = strtolower($file_extension);

					// exploding profile pic for renaming
					$profile_banenr_img_ext = explode(".", $this->profile_banenr_img);

					$new_profile_banenr_img = md5($full_name . $email . date("d-m-Y-h")) . '_profile_banenr_img' . '.' . end($profile_banenr_img_ext);
					if (in_array($file_extension, $valid_ext)) {
						parent::compressImage($new_profile_banenr_img, $this->tmp_profile_banenr_img, $this->profile_banenr_img_type, $banner_img_path);
						$profile_banenr_img = ",`banner_img`='$new_profile_banenr_img'";
					}
				}
				if (!empty($this->profile_img)) {
					if (!empty($old_file[0]['profile_img'])) {
						@unlink($picture_img_path . $old_file[0]['profile_img']);
					}

					// checking extention validation
					$file_extension = pathinfo($this->profile_img, PATHINFO_EXTENSION);
					$file_extension = strtolower($file_extension);

					// exploding profile pic for renaming
					$profile_img_ext = explode(".", $this->profile_img);

					$new_profile_img = md5($full_name . $email . date("d-m-Y-h")) . '_profile_img' . '.' . end($profile_img_ext);
					if (in_array($file_extension, $valid_ext)) {
						parent::compressImage($new_profile_img, $this->tmp_profile_img, $this->profile_img_type, $picture_img_path);
						$profile_img = ", `profile_img`='$new_profile_img'";
					}
				}
				if (!empty($this->company_img)) {

					if (!empty($old_file[0]['company_img'])) {
						@unlink($company_img_path . $old_file[0]['company_img']);
					}
					// checking extention validation
					$file_extension = pathinfo($this->company_img, PATHINFO_EXTENSION);
					$file_extension = strtolower($file_extension);

					// exploding profile pic for renaming
					$company_img_ext = explode(".", $this->company_img);

					$new_company_img = md5($full_name . $email . date("d-m-Y-h")) . '_company_img' . '.' . end($company_img_ext);
					if (in_array($file_extension, $valid_ext)) {
						parent::compressImage($new_company_img, $this->tmp_company_img, $this->company_img_type, $company_img_path);
						$company_img = ",`company_img`='$new_company_img'";
					}
				}
				// exit;
				$sql = "UPDATE `user` SET `slug`='$this->slug', `card_color`='$color_code',`full_name`='$this->full_name',`occupation`='$this->occupation',`company`='$this->company',`self_bio`='$this->self_bio',`email`='$this->email',`site_link`='$this->site_link',`mobile`='$this->mobile',`work_number`='$this->work_number',`gst`='$this->gst',`address_link`='$this->address_link',`address`='$this->address',`bank_details`='$this->bank_details',`fb_link`='$this->fb_link',`yt_link`='$this->yt_link',`ln_link`='$this->ln_link',`insta_link`='$this->insta_link',`twitter_link`='$this->twitter_link',`whats_number`='$this->whats_number' $profile_img $company_img $profile_banenr_img WHERE `id` = '$id'";
				// echo $sql;;
				// exit;

				if (parent::sql($sql)) {

					return "Success";
				} else {
					return "failed";
				}
			}
		} else {
			return "failed";
		}
	}

	//Delete Media
	public function delete_user($id )
	{
		$this->id = parent::clean($id); 
	$picture_img_path = "../../assets/profile/picture/";
				$banner_img_path = "../../assets/profile/banner/";
				$company_img_path = "../../assets/profile/company/"; 
				
		if (!empty($id)) {
			$old_data_sql = "SELECT * FROM `user` WHERE `id` = '$this->id'";

			if (parent::sql($old_data_sql)) {
				if (parent::numrows() > 0) {
				    	$old_file_ = parent::result();
				    	
				    if (!empty($old_file[0]['banner_img'])) {
						@unlink($banner_img_path . $old_file[0]['banner_img']);
					}
					
					if (!empty($old_file[0]['profile_img'])) {
						@unlink($picture_img_path . $old_file[0]['profile_img']);
					}
					
					if (!empty($old_file[0]['company_img'])) {
						@unlink($company_img_path . $old_file[0]['company_img']);
					}
					
					$sql = "DELETE FROM `user` WHERE id = '$this->id'";

					if (parent::sql($sql)) {
						return "Success";
					} else {
						return "failed";
					}
				}
			}
		}
	}
	//Delete Media
	public function update_status_profile($id, $status)
	{
		$this->id = parent::clean($id);
		$this->status = parent::clean($status);

		if (!empty($id)) {
			$old_data_sql = "SELECT * FROM `user` WHERE `id` = '$this->id'";

			if (parent::sql($old_data_sql)) {
				if (parent::numrows() > 0) {
					$sql = "UPDATE `user` SET `is_enabaled`= '$this->status' WHERE id = '$this->id'";

					if (parent::sql($sql)) {
						return "Success";
					} else {
						return "failed";
					}
				}
			}
		}
	}
	public function update_verfityStatus_profile($id, $status)
	{
		$this->id = parent::clean($id);
		$this->status = parent::clean($status);

		if (!empty($id)) {
			$old_data_sql = "SELECT * FROM `user` WHERE `id` = '$this->id'";

			if (parent::sql($old_data_sql)) {
				if (parent::numrows() > 0) {
					$sql = "UPDATE `user` SET `isVerified`= '$this->status' WHERE id = '$this->id'";

					if (parent::sql($sql)) {
						return "Success";
					} else {
						return "failed";
					}
				}
			}
		}
	}
}
