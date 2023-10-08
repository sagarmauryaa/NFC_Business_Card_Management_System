<?php
// print_r($_POST);
// die();

/* including operations class file and security file*/
include('../config/security.php');
include('./operations.php');

// creating instance
$db = new operations();
$db->connect();

// Method of Request
$method = $_SERVER['REQUEST_METHOD'];

// Only post method allowed
if ($method == "POST") {
 

	// login admin
	if (isset($_POST['login_admin']) && isset($_POST['email']) && isset($_POST['password'])) {
// 		$email = explode("-",$_POST['email'])[1];
		$email = $_POST['email'];
		$password = $_POST['password'];
// echo $password ;
// die();
		$result = $db->login_admin($email, $password);

		echo $result;
	}
 

	// logout user
	if (isset($_POST['logout_admin']) && isset($_POST['id'])) {
		$id = $_POST['id'];

		$result = $db->logout_admin($id);

		echo $result;
	} 
 
	if (isset($_POST['edit_profile']) && isset($_POST['id'])) {
		$id = base64_decode($_POST['id']);
		$name = $_POST['name'];
		$pass_code = $_POST['pass_code'];
		$email = $_POST['email'];
		$color_code = $_POST['color_code'];
		$mobile = $_POST['mobile'];
		$work_number = $_POST['work_number'];
		$whats_number = $_POST['whats_number'];
		$company_name = $_POST['company_name'];
		$designation = $_POST['designation'];
		$address = $_POST['address'];
		$bank_details = $_POST['bank_details'];
		$gst = $_POST['gst'];
		$site_link = $_POST['site_link'];
		$bio = $_POST['bio'];
		$address_link = $_POST['address_link'];
		$yt_link = $_POST['yt_link'];
		$fb_link = $_POST['fb_link'];
		$tw_link = $_POST['tw_link'];
		$ln_link = $_POST['ln_link'];
		$insta_link = $_POST['insta_link'];
		$profile_banenr_img = !empty($_FILES['profile_banenr_img']['name']) ? $_FILES['profile_banenr_img']['name'] : null;
		$tmp_profile_banenr_img = !empty($_FILES['profile_banenr_img']['tmp_name']) ? $_FILES['profile_banenr_img']['tmp_name'] : null;
		$type_profile_banenr_img = !empty($_FILES['profile_banenr_img']['type']) ? $_FILES['profile_banenr_img']['type'] : null;

		$profile_img = !empty($_FILES['profile_img']['name']) ? $_FILES['profile_img']['name'] : null;
		$tmp_profile_img = !empty($_FILES['profile_img']['tmp_name']) ? $_FILES['profile_img']['tmp_name'] : null;
		$type_profile_img = !empty($_FILES['profile_img']['type']) ? $_FILES['profile_img']['type'] : null;

		$company_img = !empty($_FILES['company_img']['name']) ? $_FILES['company_img']['name'] : null;
		$tmp_company_img = !empty($_FILES['company_img']['tmp_name']) ? $_FILES['company_img']['tmp_name'] : null;
		$type_company_img = !empty($_FILES['company_img']['type']) ? $_FILES['company_img']['type'] : null;


		$result = $db->edit_profile($pass_code, $id, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $name, $email, $mobile, $work_number, $whats_number, $company_name, $designation, $address_link, $address, $bank_details, $gst, $site_link, $bio, $yt_link, $fb_link, $tw_link, $ln_link, $insta_link, $color_code);

		echo $result;
	}
} else {
	echo "Method Not Allowed !";
}
$db->disconnect();
