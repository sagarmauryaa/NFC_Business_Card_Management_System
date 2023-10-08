/* eslint-disable no-undef */
 

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
