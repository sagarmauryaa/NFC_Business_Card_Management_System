document.addEventListener("DOMContentLoaded", function () {
	const shareButton = document.getElementById("shareButton");
	const currentURL = window.location.href;

	if (navigator.share) {
		shareButton.addEventListener("click", () => {
			navigator
				.share({
					title: "Business Card Profile",
					text: "Hi, Checkout my digital business card profile",
					url: currentURL,
				})
				.then(() => {
					console.log("Successfully shared");
				})
				.catch((error) => {
					console.error("Error sharing:", error);
				});
		});
	} else {
		// Handle the case when navigator.share() is not available
// 		shareButton.style.display = "none";
// 		alert("Sharing is not supported on this device/browser.");
	}
});

document.addEventListener("DOMContentLoaded", function () {
	const paragraph = document.getElementById("read-more-paragraph");
	const readMoreButton = document.getElementById("read-more-button");
	const readLessButton = document.getElementById("read-less-button");
	if (paragraph.getBoundingClientRect().height < 100) {
		readMoreButton.style.display = "none";
		readLessButton.style.display = "none";
	}
	// Function to count words in a string
	function countWords(text) {
		return text.split(/\s+/).filter(Boolean).length;
	}

	const paragraphText = paragraph.textContent;
	const wordCount = countWords(paragraphText);

	if (wordCount > 300) {
		readMoreButton.style.display = "inline";
	}

	readMoreButton.addEventListener("click", function () {
		paragraph.style.maxHeight = "none";
		readMoreButton.style.display = "none";
		readLessButton.style.display = "inline";
	});

	readLessButton.addEventListener("click", function () {
		paragraph.style.maxHeight = "100px"; /* Expand to full height */
		readMoreButton.style.display = "inline";
		readLessButton.style.display = "none";
	});
});
