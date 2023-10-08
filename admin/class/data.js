/* eslint-disable no-undef */
// REGISTER ADMIN
$(".register-admin").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("register_admin", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Registered Successfully") {
				window.location.href = "login";

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});

// LOGIN ADMIN
$(".login-admin").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("login_admin", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Login Successful") {
				window.location.href = "./";

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});

// FORGOT PASSWORD ADMIN
$(".forgot-password").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("forgot_password", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "OTP sent successfully") {
				window.location.href = "create-new-password";

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});

// CREATE NEW PASSWORD ADMIN
$(".create-new-password").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("create_new_password", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Password reset successful") {
				window.location.href = "login";

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});

// UPDATE ADMIN USER
$(".update-admin").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("update_admin", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Updated successfully") {
				window.location.reload();

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});

// LOGOUT USER
$(document).on("click", ".logout-admin", function () {
	var logout_id = $(this).attr("data-user");

	if (window.confirm("Are You Sure You Want To Logout ?")) {
		$.ajax({
			url: "./class/processor.php",
			type: "POST",
			data: "logout_admin=true&id=" + logout_id,
			cache: false,
			processData: false,
			beforeSend: function () {
				$("body").append(
					'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
				);
			},
			complete: function () {
				$(".site-loader").remove();
			},
			success: function (result) {
				if (result === "Logged out successfully") {
					window.location.href = "login";

					notify =
						'<div class="message-box"><div class="show alert alert-success" role="alert">' +
						result +
						"</div></div>";
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				} else {
					notify =
						'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
						result +
						"</div></div>";
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				}
			},
		});
	}
});

$(document).on("click", ".delete_user", function () {
	var id = $(this).attr("data-id"); 

	if (window.confirm("Are you sure you want to proceed ?")) {
		$.ajax({
			url: "./class/processor.php",
			type: "POST",
			data: "delete_user=true&id=" + id  ,
			cache: false,
			processData: false,
			beforeSend: function () {
				$("body").append(
					'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
				);
			},
			complete: function () {
				$(".site-loader").remove();
			},
			success: function (result) {
				if (result === "Success") {
					window.location.reload();

					notify =
						'<div class="message-box"><div class="show alert alert-success" role="alert">Deleted Successfully</div></div>';
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				} else {
					notify =
						'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
						result +
						"</div></div>";
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				}
			},
		});
	}
});

$(document).on("click", ".toggle_active", function () {
	var id = $(this).attr("data-id");
	var status = $(this).attr("data-status");

	if (window.confirm("Are you sure you want to proceed ?")) {
		$.ajax({
			url: "./class/processor.php",
			type: "POST",
			data: "update_status_profile=true&id=" + id + "&status=" + status,
			cache: false,
			processData: false,
			beforeSend: function () {
				$("body").append(
					'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
				);
			},
			complete: function () {
				$(".site-loader").remove();
			},
			success: function (result) {
				if (result === "Success") {
					window.location.reload();

					notify =
						'<div class="message-box"><div class="show alert alert-success" role="alert">Status Updated Successfully</div></div>';
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				} else {
					notify =
						'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
						result +
						"</div></div>";
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				}
			},
		});
	}
});
$(document).on("click", ".toggle_verify", function () {
	var id = $(this).attr("data-id");
	var status = $(this).attr("data-status");

	if (window.confirm("Are you sure you want to proceed ?")) {
		$.ajax({
			url: "./class/processor.php",
			type: "POST",
			data:
				"update_verfityStatus_profile=true&id=" +
				id +
				"&status=" +
				status,
			cache: false,
			processData: false,
			beforeSend: function () {
				$("body").append(
					'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
				);
			},
			complete: function () {
				$(".site-loader").remove();
			},
			success: function (result) {
				if (result === "Success") {
					window.location.reload();

					notify =
						'<div class="message-box"><div class="show alert alert-success" role="alert">Status Updated Successfully</div></div>';
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				} else {
					notify =
						'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
						result +
						"</div></div>";
					$("body").append(notify);
					$(".message-box").fadeOut(5000);
				}
			},
		});
	}
});

// ADD PUBLICATIONS
$(".add-profile").on("submit", function (e) {
	e.preventDefault();
	for (var i in CKEDITOR.instances) {
		CKEDITOR.instances[i].updateElement();
	}
	var formdata = new FormData(this);
	formdata.append("add_profile", true);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Success") {
				window.location.reload();

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">Added Successfully</div></div>';
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});
$(".edit-profile").on("submit", function (e) {
	e.preventDefault();
	for (var i in CKEDITOR.instances) {
		CKEDITOR.instances[i].updateElement();
	}
	var id = $(this).attr("data-id");

	var formdata = new FormData(this);
	formdata.append("edit_profile", true);
	formdata.append("id", id);

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (result) {
			var notify = "";

			if (result === "Success") {
				window.location.reload();

				notify =
					'<div class="message-box"><div class="show alert alert-success" role="alert">Updated Successfully</div></div>';
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
	});
});
