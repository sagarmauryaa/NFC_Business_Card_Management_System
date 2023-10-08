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
	// add admin
	if (isset($_POST['register_admin']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$result = $db->register_admin($name, $email, $phone, $password);

		echo $result;
	}

	// login admin
	if (isset($_POST['login_admin']) && isset($_POST['email']) && isset($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$result = $db->login_admin($email, $password);

		echo $result;
	}

	// forgot password admin
	if (isset($_POST['forgot_password']) && isset($_POST['email']) && isset($_POST['phone'])) {
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$result = $db->forgot_password($email, $phone);

		echo $result;
	}

	// create new password admin
	if (isset($_POST['create_new_password']) && isset($_POST['password']) && isset($_POST['otp'])) {
		$password = $_POST['password'];
		$otp = $_POST['otp'];

		$result = $db->create_new_password($password, $otp);

		echo $result;
	}

	// update admin profile
	if (isset($_POST['update_admin'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = !empty($_POST['password']) ? $_POST['password'] : null;

		$result = $db->update_admin($name, $email, $phone, $password);

		echo $result;
	}

	// logout user
	if (isset($_POST['logout_admin']) && isset($_POST['id'])) {
		$id = $_POST['id'];

		$result = $db->logout_admin($id);

		echo $result;
	}
	// add new Category
	if (isset($_POST['status_books_cat']) &&  isset($_POST['id']) && isset($_POST['status'])) {
		$id =  $_POST['id'];
		$status = 1;
		if ($_POST['status'] == 1) {
			$status = 0;
		}
		$result = $db->sql("UPDATE `books` SET `is_upcoming`='$status' WHERE `id`= $id");
		if ($result) {
			echo "Success";
		} else {
			echo "Failed";
		}
	}

	// add new Category
	if (isset($_POST['fetch_cat'])) {
		$id = $_POST['cat_id'];

		$sql = "SELECT * FROM `category` WHERE `id`=$id";
		if ($db->sql($sql)) {
			echo json_encode(["data" => $db->result()]);
		}
	}
	if (isset($_POST['delete_user']) && isset($_POST['id']) ) {
			$id = base64_decode($_POST['id']);
		$result = $db->delete_user($id );
		echo $result;
	}

	if (isset($_POST['update_status_profile']) && isset($_POST['id']) && isset($_POST['status'])) {
		$id = $_POST['id'];
		$status = $_POST['status'] == 1 ? 0 : 1;
		$result = $db->update_status_profile($id, $status);
		echo $result;
	}
	if (isset($_POST['update_verfityStatus_profile']) && isset($_POST['id']) && isset($_POST['status'])) {
		$id = $_POST['id'];
		$status = $_POST['status'] == 1 ? 0 : 1;
		$result = $db->update_verfityStatus_profile($id, $status);
		echo $result;
	}
	// Add Profile
	if (isset($_POST['add_profile']) && isset($_POST['slug'])) {
		$slug = $_POST['slug'];
		$name = $_POST['name'];
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
		$yt_link = $_POST['yt_link'];
		$address_link = $_POST['address_link'];
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


		$result = $db->add_profile($slug, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $name, $email, $mobile, $work_number, $whats_number, $company_name, $designation, $address_link, $address, $bank_details, $gst, $site_link, $bio, $yt_link, $fb_link, $tw_link, $ln_link, $insta_link, $color_code);

		echo $result;
	}
	if (isset($_POST['edit_profile']) && isset($_POST['id']) && isset($_POST['slug'])) {
		$id = base64_decode($_POST['id']);
		$name = $_POST['name'];
		$slug = $_POST['slug'];
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


		$result = $db->edit_profile($slug, $id, $profile_banenr_img, $tmp_profile_banenr_img, $type_profile_banenr_img, $profile_img, $tmp_profile_img, $type_profile_img, $company_img, $tmp_company_img, $type_company_img, $name, $email, $mobile, $work_number, $whats_number, $company_name, $designation, $address_link, $address, $bank_details, $gst, $site_link, $bio, $yt_link, $fb_link, $tw_link, $ln_link, $insta_link, $color_code);

		echo $result;
	}
} else {
	echo "Method Not Allowed !";
}
$db->disconnect();
