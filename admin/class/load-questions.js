/* eslint-disable no-undef */
(function ($) {
	"use strict";

	var url = new URL(window.location.href);

	var type = url.searchParams.get("type");
	var id = url.searchParams.get("id");

	$.ajax({
		url: "./class/processor.php",
		type: "POST",
		data: { load_questions: true, type: type, id: id },
		cache: false,
		// dataType: "JSON",
		beforeSend: function () {
			$("body").append(
				'<div class="site-loader"><div class="bar-loader"><span></span><span></span><span></span><span></span></div></div>'
			);
		},
		complete: function () {
			$(".site-loader").remove();
		},
		success: function (response) {
			var notify = "";

			// console.log(typeof response);
			// console.log(response);
			var result = JSON.parse(response);

			// console.log(result);

			if (result.message === "Success") {
				loadQuestions(result.data);
			} else {
				notify =
					'<div class="message-box"><div class="show alert alert-danger" role="alert">' +
					result +
					"</div></div>";
				$("body").append(notify);
				$(".message-box").fadeOut(5000);
			}
		},
		error: function (params) {
			console.log(params);
		},
	});
})(jQuery);

async function loadQuestions(oldData = []) {
	// console.log(oldData);

	var repeater = await $(".repeater").repeater({
		// (Optional)
		// "defaultValues" sets the values of added items.  The keys of
		// defaultValues refer to the value of the input's name attribute.
		// If a default value is not specified for an input, then it will
		// have its value cleared.
		defaultValues: {
			"text-input": "",
		},
		repeaters: [
			{
				// (Required)
				// Specify the jQuery selector for this nested repeater
				selector: ".answers-list",
				defaultValues: {
					"text-input": "",
				},
				show: function () {
					$(this).slideDown();
					resetName();
				},
				hide: function (deleteAnswer) {
					if (
						window.confirm(
							"Are you sure you want to delete this answer?"
						)
					) {
						$(this).slideUp(deleteAnswer);
					}

					setTimeout(() => {
						resetName();
					}, 2000);
				},
				ready: function (setIndexes) {
					// console.log(setIndexes);
					resetName();
				},
				isFirstItemUndeletable: true,
			},
		],
		// (Optional)
		// "show" is called just after an item is added.  The item is hidden
		// at this point.  If a show callback is not given the item will
		// have $(this).show() called on it.
		show: function () {
			$(this).slideDown();
			resetName();
		},
		// (Optional)
		// "hide" is called when a user clicks on a data-repeater-delete
		// element.  The item is still visible.  "hide" is passed a function
		// as its first argument which will properly remove the item.
		// "hide" allows for a confirmation step, to send a delete request
		// to the server, etc.  If a hide callback is not given the item
		// will be deleted.
		hide: function (deleteQuestion) {
			if (
				!$(this).hasClass("input-group") &&
				window.confirm("Are you sure you want to delete this question?")
			) {
				$(this).slideUp(deleteQuestion);
			}

			setTimeout(() => {
				resetName();
			}, 2000);
		},

		ready: function (setIndexes) {
			// console.log(setIndexes);
			resetName();
		},
		// (Optional)
		// Removes the delete button from the first list item,
		// defaults to false.
		isFirstItemUndeletable: true,
	});

	// var oldData = [
	// 	{
	// 		question: "Accountant",
	// 		answers: [
	// 			{
	// 				answer: "Accountant 1",
	// 			},
	// 			{
	// 				answer: "Accountant 2",
	// 			},
	// 			{
	// 				answer: "Accountant 3",
	// 			},
	// 			{
	// 				answer: "Accountant 4",
	// 			},
	// 			"2",
	// 		],
	// 	},
	// 	{
	// 		question: "Mumbai",
	// 		answers: [
	// 			{
	// 				answer: "Mumbai 1",
	// 			},
	// 			{
	// 				answer: "Mumbai 2",
	// 			},
	// 			{
	// 				answer: "Mumbai 3",
	// 			},
	// 			{
	// 				answer: "Mumbai 4",
	// 			},
	// 			"3",
	// 		],
	// 	},
	// 	{
	// 		question: "is today sunday ?",
	// 		answers: [
	// 			{
	// 				answer: "true",
	// 			},
	// 			{
	// 				answer: "false",
	// 			},
	// 			"1",
	// 		],
	// 	},
	// ];

	if (oldData.length > 0) {
		var newData = [];

		oldData.forEach((elem) => {
			newData.push({
				question: elem.question,
				answers: elem.answers.slice(0, -1),
			});
		});

		// console.log(newData);
		await repeater.setList(newData);

		oldData.forEach((elem) => {
			// console.log(parseInt(elem.answers.splice(-1)[0]));
			// resetValues(parseInt(elem.answers.splice(-1)[0]));
			// var uniqueRadios = [];
			var answerKey = elem.answers.splice(-1)[0];

			document
				.querySelectorAll(".form-control.answer-field")
				.forEach((answer) => {
					// if (elem.answers[answerKey]) {
					// 	console.log(answer.value);
					// }
					var selectedAnswer = elem.answers[answerKey].answer;

					// console.log(selectedAnswer);
					// console.log(answer.value);

					if (selectedAnswer === answer.value) {
						// console.log($(answer).parent().prev().find("input"));

						$(answer)
							.parent()
							.prev()
							.find("input")
							.prop("checked", true);
					}
				});

			// uniqueRadios.forEach((radio) => {

			// })
		});
	}
}

// reset input radio dynamic name

function resetName() {
	var radioBtns = document.querySelectorAll(".form-check-input");

	radioBtns.forEach(function (radio) {
		var radioName = radio.getAttribute("name").split("[answers]");

		var newRadioName = radioName[0] + "[answers][answer-option]";

		$(radio).attr("name", newRadioName);

		// console.log(radioName);
		// console.log(newRadioName);
	});

	resetValues();
}

function resetValues() {
	var uniqueRadios = [];

	document.querySelectorAll(".form-check-input[name]").forEach((elem) => {
		if (uniqueRadios.indexOf(elem.name) === -1) {
			uniqueRadios.push(elem.name);
		}
	});

	uniqueRadios.forEach((radio) => {
		var allRadios = document.querySelectorAll(
			`.form-check-input[name="${radio}"]`
		);

		allRadios.forEach((radElem, index) => {
			radElem.value = index;

			// console.log(radElem);

			// if (selectedAnswer !== undefined && selectedAnswer === index) {
			// 	console.log(radElem);
			// }

			// check if selected answer is not null
			// if (selectedAnswer !== undefined) {
			// 	// check if item is not null
			// 	if (allRadios.item(selectedAnswer)) {
			// 		allRadios.item(selectedAnswer).checked = true;

			// 		// console.log(allRadios.item(selectedAnswer));
			// 	}
			// }
		});
	});

	// console.log(uniqueRadios);
}
