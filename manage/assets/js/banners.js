function image_upload(input, imgWidth, imgHeight) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(input.files[0]);

		reader.onload = function (e) {
			if (imgHeight && imgWidth) {
				// check image size
				var image = new Image();
				image.src = e.target.result;

				image.onload = function () {
					var height = this.height;
					var width = this.width;

					// console.log(width + ", " + height);

					if (height > imgHeight || width > imgWidth) {
						alert(
							`Please Upload Image in Proper Size\nWidth: ${imgWidth}px & Height: ${imgHeight}px`
						);
						return false;
					} else {
						$(input)
							.parent()
							.parent()
							.find(".site_image_preview")
							.attr("src", e.target.result);
						$(input)
							.parent()
							.parent()
							.find(".site_image_preview")
							.hide();
						$(input)
							.parent()
							.parent()
							.find(".site_image_preview")
							.fadeIn(650);
					}
				};
			} else {
				$(input)
					.parent()
					.parent()
					.find(".site_image_preview")
					.attr("src", e.target.result);
				$(input).parent().parent().find(".site_image_preview").hide();
				$(input)
					.parent()
					.parent()
					.find(".site_image_preview")
					.fadeIn(650);
			}
		};

		if (input.files.length > 1) {
			if (
				$(input).parent().parent().find(".images_count_span").length > 0
			) {
				$(input).parent().parent().find(".images_count_span").remove();
			}

			$(input)
				.parent()
				.parent()
				.append(
					'<span class="images_count_span">+' +
						(input.files.length - 1) +
						" More</span>"
				);
		}
	}
}

$(".site_banner").change(function () {
	image_upload(this, 1400, 350);
});

$(".homepage_background").change(function () {
	image_upload(this);
});

$(".blog_image").change(function () {
	image_upload(this);
});

$(".profile_photo").change(function () {
	image_upload(this);
});

// function ekUpload() {
// 	function Init() {
// 		console.log("Upload Initialised");

// 		var fileSelect = document.getElementById("file-upload"),
// 			fileDrag = document.getElementById("file-drag"),
// 			submitButton = document.getElementById("submit-button");

// 		fileSelect.addEventListener("change", fileSelectHandler, false);

// 		// Is XHR2 available?
// 		var xhr = new XMLHttpRequest();
// 		if (xhr.upload) {
// 			// File Drop
// 			fileDrag.addEventListener("dragover", fileDragHover, false);
// 			fileDrag.addEventListener("dragleave", fileDragHover, false);
// 			fileDrag.addEventListener("drop", fileSelectHandler, false);
// 		}
// 	}

// 	function fileDragHover(e) {
// 		var fileDrag = document.getElementById("file-drag");

// 		e.stopPropagation();
// 		e.preventDefault();

// 		fileDrag.className =
// 			e.type === "dragover" ? "hover" : "modal-body file-upload";
// 	}

// 	function fileSelectHandler(e) {
// 		// Fetch FileList object
// 		var files = e.target.files || e.dataTransfer.files;

// 		// Cancel event and hover styling
// 		fileDragHover(e);

// 		// Process all File objects
// 		for (var i = 0, f; (f = files[i]); i++) {
// 			parseFile(f);
// 			uploadFile(f);
// 		}
// 	}

// 	// Output
// 	function output(msg) {
// 		// Response
// 		var m = document.getElementById("messages");
// 		m.innerHTML = msg;
// 	}

// 	function parseFile(file) {
// 		console.log(file.name);
// 		output("<strong>" + encodeURI(file.name) + "</strong>");

// 		// var fileType = file.type;
// 		// console.log(fileType);
// 		var imageName = file.name;

// 		var isGood = /\.(?=gif|jpg|png|jpeg)/gi.test(imageName);
// 		if (isGood) {
// 			document.getElementById("start").classList.add("hidden");
// 			document.getElementById("response").classList.remove("hidden");
// 			document.getElementById("notimage").classList.add("hidden");
// 			// Thumbnail Preview
// 			document.getElementById("file-image").classList.remove("hidden");
// 			document.getElementById("file-image").src =
// 				URL.createObjectURL(file);
// 		} else {
// 			document.getElementById("file-image").classList.add("hidden");
// 			document.getElementById("notimage").classList.remove("hidden");
// 			document.getElementById("start").classList.remove("hidden");
// 			document.getElementById("response").classList.add("hidden");
// 			document.getElementById("file-upload-form").reset();
// 		}
// 	}

// 	function setProgressMaxValue(e) {
// 		var pBar = document.getElementById("file-progress");

// 		if (e.lengthComputable) {
// 			pBar.max = e.total;
// 		}
// 	}

// 	function updateFileProgress(e) {
// 		var pBar = document.getElementById("file-progress");

// 		if (e.lengthComputable) {
// 			pBar.value = e.loaded;
// 		}
// 	}

// 	function uploadFile(file) {
// 		var xhr = new XMLHttpRequest(),
// 			fileInput = document.getElementById("class-roster-file"),
// 			pBar = document.getElementById("file-progress"),
// 			fileSizeLimit = 1024; // In MB
// 		if (xhr.upload) {
// 			// Check if file is less than x MB
// 			if (file.size <= fileSizeLimit * 1024 * 1024) {
// 				// Progress bar
// 				pBar.style.display = "inline";
// 				xhr.upload.addEventListener(
// 					"loadstart",
// 					setProgressMaxValue,
// 					false
// 				);
// 				xhr.upload.addEventListener(
// 					"progress",
// 					updateFileProgress,
// 					false
// 				);

// 				// File received / failed
// 				xhr.onreadystatechange = function (e) {
// 					if (xhr.readyState === 4) {
// 						// Everything is good!
// 						// progress.className = (xhr.status == 200 ? "success" : "failure");
// 						// document.location.reload(true);
// 					}
// 				};

// 				// Start upload
// 				xhr.open(
// 					"POST",
// 					document.getElementById("file-upload-form").action,
// 					true
// 				);
// 				xhr.setRequestHeader("X-File-Name", file.name);
// 				xhr.setRequestHeader("X-File-Size", file.size);
// 				xhr.setRequestHeader("Content-Type", "multipart/form-data");
// 				xhr.send(file);
// 			} else {
// 				output(
// 					"Please upload a smaller file (< " + fileSizeLimit + " MB)."
// 				);
// 			}
// 		}
// 	}

// 	// Check for the various File API support.
// 	if (window.File && window.FileList && window.FileReader) {
// 		Init();
// 	} else {
// 		document.getElementById("file-drag").style.display = "none";
// 	}
// }
// ekUpload();
