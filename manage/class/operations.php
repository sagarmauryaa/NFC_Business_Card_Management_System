<?php
session_start();
include("../config/conn.php");

class operations extends database
{

	private $profile_banenr_img, $tmp_profile_banenr_img, $profile_banenr_img_type, $profile_img, $tmp_profile_img, $profile_img_type, $company_img, $tmp_company_img, $company_img_type, $full_name, $email, $mobile, $work_number, $whats_number, $company, $occupation, $address, $bank_details, $gst, $site_link, $self_bio, $address_link, $fb_link, $yt_link, $twitter_link, $ln_link, $insta_link, $pass_code, $name, $token, $phone, $password, $slug, $isVerified, $status, $id;
 

	// login admin function
	public function login_admin($email, $password)
	{
		$this->email = parent::clean($email);
		$this->password = sha1("sagar" . parent::clean($password) . "maurya");

		$check_user = "SELECT * FROM `user` WHERE `email` = '$this->email'";
// 		echo
// 		$this->password,
// 		$check_user;
// 		die();
		if (parent::sql($check_user)) {
			if (parent::numrows() >= 1) {
				$user_data = parent::result();

				if ($this->password == $user_data[0]['pass_code']) {

					$_SESSION['user_id'] = $user_data[0]['id'];
					$_SESSION['user_name'] = $user_data[0]['name'];
					$_SESSION['user_email'] = $user_data[0]['email'];

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
	edit_profile($pass_code, $id, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $full_name, $email, $mobile, $work_number, $whats_number, $company, $occupation, $address_link, $address, $bank_details, $gst, $site_link, $self_bio, $yt_link, $fb_link, $twitter_link, $ln_link, $insta_link, $color_code)
	{

		$checksql = "SELECT * FROM `user` WHERE `id` = '$id'";
// 	echo
	
// 		$checksql;
// 		die();

		if (parent::sql($checksql)) {
			$datanumrows = parent::numrows();
			$old_file = parent::result();
			if ($datanumrows > 0) {
				$this->id = $id;

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
				$pass_update ="";
				if(!empty($pass_code)){
				    $this->pass_code = sha1("sagar" . parent::clean($pass_code) . "maurya");
				    $pass_update = ", `pass_code`='$this->pass_code'";
				}
				// exit;
				$sql = "UPDATE `user` SET `card_color`='$color_code',`full_name`='$this->full_name',`occupation`='$this->occupation',`company`='$this->company',`self_bio`='$this->self_bio',`email`='$this->email',`site_link`='$this->site_link',`mobile`='$this->mobile',`work_number`='$this->work_number',`gst`='$this->gst',`address_link`='$this->address_link',`address`='$this->address',`bank_details`='$this->bank_details',`fb_link`='$this->fb_link',`yt_link`='$this->yt_link',`ln_link`='$this->ln_link',`insta_link`='$this->insta_link',`twitter_link`='$this->twitter_link',`whats_number`='$this->whats_number' $pass_update  $profile_img $company_img $profile_banenr_img WHERE `id` = '$id'";
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
}
