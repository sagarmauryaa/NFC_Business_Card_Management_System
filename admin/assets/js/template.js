(function ($) {
	("use strict");

	$(function () {
		var body = $("body");
		var sidebar = $(".sidebar");

		//Add active class to nav-link based on url dynamically
		//Active class can be hard coded directly in html file also as required

		function addActiveClass(element) {
			if (current === "") {
				//for root url
				if (element.attr("href") === "./") {
					element.parents(".nav-item").last().addClass("active");
					if (element.parents(".sub-menu").length) {
						element.closest(".collapse").addClass("show");
						element.addClass("active");
					}
				}
			} else {
				//for other url
				if (element.attr("href").indexOf(current) !== -1) {
					element.parents(".nav-item").last().addClass("active");
					if (element.parents(".sub-menu").length) {
						element.closest(".collapse").addClass("show");
						element.addClass("active");
					}
					if (element.parents(".submenu-item").length) {
						element.addClass("active");
					}
				}

				// console.log(element.attr("href"));
				// console.log(current);
			}
		}

		var current = window.location.pathname
			.split("/")
			.slice(-1)[0]
			.replace(/^\/|\/$/g, "");

		// var current = window.location.href.split("/").slice(-1)[0];

		$(".nav li a", sidebar).each(function () {
			var $this = $(this);
			addActiveClass($this);
		});

		$(".horizontal-menu .nav li a").each(function () {
			var $this = $(this);
			addActiveClass($this);
		});

		//Close other submenu in sidebar on opening any

		sidebar.on("show.bs.collapse", ".collapse", function () {
			sidebar.find(".collapse.show").collapse("hide");
		});

		$('[data-toggle="minimize"]').on("click", function () {
			if (
				body.hasClass("sidebar-toggle-display") ||
				body.hasClass("sidebar-absolute")
			) {
				body.toggleClass("sidebar-hidden");
			} else {
				body.toggleClass("sidebar-icon-only");
			}
		});

		//checkbox and radios
		$(".form-check label,.form-radio label").append(
			'<i class="input-helper"></i>'
		);

		//Horizontal menu in mobile
		$('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
			$(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
		});
		// Horizontal menu navigation in mobile menu on click
		var navItemClicked = $(".horizontal-menu .page-navigation >.nav-item");
		navItemClicked.on("click", function (event) {
			if (window.matchMedia("(max-width: 991px)").matches) {
				if (!$(this).hasClass("show-submenu")) {
					navItemClicked.removeClass("show-submenu");
				}
				$(this).toggleClass("show-submenu");
			}
		});

		$(window).scroll(function () {
			if (window.matchMedia("(min-width: 992px)").matches) {
				var header = $(".horizontal-menu");
				if ($(window).scrollTop() >= 70) {
					$(header).addClass("fixed-on-scroll");
				} else {
					$(header).removeClass("fixed-on-scroll");
				}
			}
		});

		if ($(".navbar").hasClass("fixed-top")) {
			document
				.querySelector(".page-body-wrapper")
				.classList.remove("pt-0");
			document.querySelector(".navbar").classList.remove("pt-5");
		} else {
			document.querySelector(".page-body-wrapper").classList.add("pt-0");
			document.querySelector(".navbar").classList.add("pt-5");
			document.querySelector(".navbar").classList.add("mt-3");
		}
	});

	(function ($) {
		"use strict";
		$(function () {
			$('[data-toggle="offcanvas"]').on("click", function () {
				$(".sidebar-offcanvas").toggleClass("active");
			});
		});
	})(jQuery);

	// table
	if ($("#hireTable").length > 0) {
		$(document).ready(function () {
			var hireTable = $("#hireTable").DataTable({
				responsive: true,
				searching: true,
				pagination: true,
				lengthChange: false,
				info: true,
				aaSorting: [],
				dom: "fBrtip",
				buttons: {
					dom: {
						button: {
							className: "",
						},
					},
					buttons: [
						{
							extend: "csvHtml5",
							exportOptions: {
								columns: ":not(.action-column)",
							},
							className: "btn btn-outline-primary",
						},
						{
							extend: "pdfHtml5",
							orientation: "landscape",
							pageSize: "LEGAL",
							exportOptions: {
								columns: "th:not(.action-column)",
							},
							className: "btn btn-outline-primary",
						},
						{
							extend: "excel",
							exportOptions: {
								columns: "th:not(.action-column)",
							},
							className: "btn btn-outline-primary",
						},
						{
							extend: "colvis",
							exportOptions: {
								columns: "th:not(.action-column)",
							},
							className: "btn btn-primary",
						},
					],
				},
			});

			// Refilter the table
			$("#min, #max").on("change", function () {
				hireTable.draw();
			});

			var minDate = $("#min");
			var maxDate = $("#max");

			// Custom filtering function which will search data in column four between two values
			$.fn.dataTable.ext.search.push(function (
				settings,
				data,
				dataIndex
			) {
				var min = minDate.val();
				var max = maxDate.val();
				var date = new Date(data[1]);

				// console.log(min);
				// console.log(max);
				// console.log(date);

				if (
					(min === null && max === null) ||
					(min === null && date <= max) ||
					(min <= date && max === null) ||
					(min <= date && date <= max)
				) {
					return true;
				}
				return false;
			});

			// Create date inputs
			minDate = new DateTime($("#min"), {
				format: "DD MMMM YYYY",
			});
			maxDate = new DateTime($("#max"), {
				format: "DD MMMM YYYY",
			});
		});
	}

	// go back btn
	$(".go-back-btn").on("click", function (e) {
		e.preventDefault();

		// console.log(window.history);

		if (window.history.length === 1) {
			window.close();
		} else {
			window.history.back(-1);
		}
	});

	// hide console warnings
	console.warn = () => {};
	// console.error = () => {};
	console.info = () => {};
})(jQuery);
