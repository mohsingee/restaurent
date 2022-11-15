$("body").on("keyup", "#current_password", function (e) {
	e.preventDefault();
	let current_password = $('#current_password').val();
	$.ajax({
		method: "Post",
		url: 'check-password',
		dataType: 'html',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			'current_password': current_password,
		},
		success: function (response) {
			if (response == "false") {
				$("#check_current_password").html(
					"<font color=red>Current Password is Incorrect</font>");
			} else if (response == "true") {
				$("#check_current_password").html(
					"<font color=green>Current Password is Correct</font>");
			}
		}
	});
});

$("body").on("keyup", "#checked_password", function (e) {
	e.preventDefault();
	let checked_password = $('#checked_password').val();
	$.ajax({
		method: "Post",
		url: 'checked-password',
		dataType: 'html',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			'checked_password': checked_password,
		},
		success: function (response) {
			if (response == "false") {
				$("#checked_current_password").html(
					"<font color='red'>Current Password is Incorrect</font>");
			} else if (response == "true") {
				$("#checked_current_password").html(
					"<font color='green'>Current Password is Correct</font>");
			}
		}
	});
});

$("body").on("keyup", "#email_check", function (e) {
	e.preventDefault();
	let email_check = $('#email_check').val();
	$.ajax({
		method: "Post",
		url: 'check-email',
		dataType: 'html',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			'email_check': email_check,
		},
		success: function (response) {
			if (response == "false") {
				$('#email_check').addClass('is-invalid');
				$("#email_message").html(
					"<font color=red>The email has already been taken</font>");
			} else if (response == "true") {
				$("#email_message").html('');
				$('#email_check').attr('title', '');
			}
		}
	});
});

$("body").on("submit", "#addCategoryForm", function (e) {
	e.preventDefault();
	$.ajax({
		type: "post",
		url: "category",
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#addCategory").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {
			$("#addCategory").modal("hide");
			Swal.fire({
				// position: 'top-end',
				toast: true,
				// showConfirmButton: false,
				timer: 2000,
				icon: 'error',
				text: response.message,
			});
			setTimeout(function () {
				location.reload();
			}, 3000);
		},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

/**
 * @author Mohsin Shafique
 *
 * Generic Ajax Request
 */
$('body').on('click', '.delete_btn', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
						"content"
					),
				},
			});
			$.ajax({
				type: "DELETE",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					Swal.fire("Deleted!", response.message, "success");
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})

$("body").on("click", ".edit_category", function () {
	let id = $(this).attr("data-id");
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		url: "category-edit",
		data: {
			id: id,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			$("#updateCategoryForm .title").val(response.title);
			if (response.type == "Product") {
				$('.types [value=1]').attr('selected', 'true');
			} else if (response.type == "Service") {
				$('.types [value=0]').attr('selected', 'true');
			}
			$("#updateCategoryForm .title").attr(
				"data-id",
				response.id
			);
			$("#updateCategory").modal("show");

			// location.reload();
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

$("body").on("submit", "#updateCategoryForm", function (e) {
	e.preventDefault();
	let id = $("#updateCategoryForm .title").attr("data-id");
	$.ajax({
		type: "post",
		url: "category/" + id,
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#updateCategory").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

function changeStatus(id, status, passurl) {
	Swal.fire({
		title: "Are you sure?",
		text: "You want to change the status!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Change it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "post",
				url: passurl,
				data: {
					'id': id,
					'status': status
				},
				dataType: "json",
				beforeSend: function () {
					$(".loader-wrapper").fadeIn("slow");
				},
				success: function (response) {
					Swal.fire("Done!", response.message, "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function (response) {},
				complete: function () {
					$(".loader-wrapper").fadeOut("slow");
				}
			});
		}

	});
}

function RejectStatus(id, status, passurl) {
	Swal.fire({
		title: 'Add Reason For Rejected!',
		input: 'text',
		inputAttributes: {
		  autocapitalize: 'off'
		},
		inputValidator: (value) => {
			if (!value) {
			  return 'Please Add Reason!'
			}
		},
		showCancelButton: true,
		confirmButtonText: 'Save',
		showLoaderOnConfirm: true,
		allowOutsideClick: () => !Swal.isLoading()
	  }).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "post",
				url: passurl,
				data: {
					'id': id,
					'status': status,
					'reason': result.value
				},
				dataType: "json",
				beforeSend: function () {
					$(".loader-wrapper").fadeIn("slow");
				},
				success: function (response) {
					Swal.fire("Rejected!", response.message, "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function (response) {},
				complete: function () {
					$(".loader-wrapper").fadeOut("slow");
				}
			});
		}

	});
}

function status(id, status) {
	Swal.fire({
		title: "Are you sure?",
		text: "You want to change the status!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Change it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "PUT",
				url: "status-change/" + id,
				data: {
					'status': status
				},
				dataType: "json",
				beforeSend: function () {
					$(".loader-wrapper").fadeIn("slow");
				},
				success: function (response) {
					Swal.fire("Changed!", response.message, "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function (response) {},
				complete: function () {
					$(".loader-wrapper").fadeOut("slow");
				}
			});
		}

	});
}

$("body").on("submit", "#addPermissionForm", function (e) {
	e.preventDefault();
	$.ajax({
		type: "post",
		url: "permissions",
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#addPermission").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {
			$("#addPermission").modal("hide");
			Swal.fire({
				// position: 'top-end',
				toast: true,
				// showConfirmButton: false,
				timer: 2000,
				icon: 'error',
				text: response.message,
			});
			setTimeout(function () {
				location.reload();
			}, 3000);
		},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

$("body").on("change", "#countrySelected", function () {
	let country_id = $('#countrySelected').val();
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		url: "/get-state",
		data: {
			country_id: country_id,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response) {
				$("#stateSelected").empty();
				// $("#inputState").append('<option disabled selected>Select State</option>');
				$.each(response, function (key, value) {
					$("#stateSelected").append('<option value="' + key + '">' + value + '</option>');
				});
			} else {
				$("#stateSelected").empty();
				$("#stateSelected").append('<option>Select Country First</option>');
			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

$("body").on("submit", "#consumerRegistration", function (e) {
	e.preventDefault();
	$.ajax({
		type: "post",
		url: "register",
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			console.log(response.errors);
			if (response.status == "success") {
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				// setTimeout(function () {
				//     location.reload();
				// }, 3000);
			}
			if (response.status == "errors") {
				html = '<p>'
				$.each(response.errors, function (prefix, val) {

					html = html + "" + val + "<br>";

				});
				html = html + "</p>";
				/// alert(html);
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 6000,
					icon: 'error',
					text: html,
				});
				///  $('#info').html(html);
			}

		},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

function getsubcategory(parent_key, boxid) {
	data = $('#' + parent_key).val();
	// product = $('#inlineCheckbox1').val();
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

	$.ajax({
		type: "post",
		url: "/get-subcategory",
		data: {
			parent_key: data,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {

			if (response) {
				console.log(response);
				// $.each(response, function(key, value) {

				//     $("#" + boxid).append('<option value="' + value['key'] + '">' + value['title'] + '</option>');

				// });
				$('#' + boxid).html(response);
				if (boxid == 'second_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#third_level').html('<option disabled>Sub Category 2</option');
					$('#third_level').multiselect('rebuild');
					$('#fourth_level').html('<option disabled>Sub Category 3</option');
					$('#fourth_level').multiselect('rebuild');
				} else if (boxid == 'third_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#fourth_level').html('<option disabled>Sub Category 3</option');
					$('#fourth_level').multiselect('rebuild');
				}
				$('#' + boxid).multiselect('rebuild');
				if (boxid == 'third_level' && data != '') {
					$('.listing_selected').attr('checked', 'true');
				}

			} else {

			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
}

function getProducts(parent_key, boxid) {
	// let dropDown = document.getElementById("second_level");
	// dropDown.selectedIndex = 0;
	data = $('#' + parent_key).val();
	// product = $('#inlineCheckbox1').val();
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		beforeSend: function () {
			$('.ajax-loader').css("visibility", "visible");
		},
		url: "/get-products",
		data: {
			parent_key: data,
		},
		dataType: "json",
		success: function (response) {

			if (response) {
				console.log(response);
				// $.each(response, function(key, value) {

				//     $("#" + boxid).append('<option value="' + value['key'] + '">' + value['title'] + '</option>');

				// });
				$('#' + boxid).html(response);
				$('#' + boxid).multiselect('rebuild');
				if (boxid == 'third_level' && data != '') {
					$('.listing_selected').attr('checked', 'true');
				}

			} else {

			}
		},
		error: function (response) {},
		complete: function () {
			$('.ajax-loader').css("visibility", "hidden");
		},
	});
}

function getServices(parent_key, boxid) {

	data = $('#' + parent_key).val();
	// product = $('#inlineCheckbox1').val();
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		beforeSend: function () {
			$('.ajax-loader').css("visibility", "visible");
		},
		url: "/get-services",
		data: {
			parent_key: data,
		},
		dataType: "json",
		success: function (response) {

			if (response) {
				console.log(response);
				// $.each(response, function(key, value) {

				//     $("#" + boxid).append('<option value="' + value['key'] + '">' + value['title'] + '</option>');

				// });
				$('#' + boxid).html(response);
				$('#' + boxid).multiselect('rebuild');
				if (boxid == 'third_level' && data != '') {
					$('.listing_selected').attr('checked', 'true');
				}

			} else {

			}
		},
		error: function (response) {},
		complete: function () {
			$('.ajax-loader').css("visibility", "hidden");
		},
	});
}

function getProductsAndServices(parent_key, boxid) {

	data = $('#' + parent_key).val();
	// product = $('#inlineCheckbox1').val();
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		beforeSend: function () {
			$('.ajax-loader').css("visibility", "visible");
		},
		url: "/get-products-services",
		data: {
			parent_key: data,
		},
		dataType: "json",
		success: function (response) {
			if (response) {
				console.log(response);
				// $.each(response, function(key, value) {

				//     $("#" + boxid).append('<option value="' + value['key'] + '">' + value['title'] + '</option>');

				// });
				$('#' + boxid).html(response);
				$('#' + boxid).multiselect('rebuild');
				if (boxid == 'third_level' && data != '') {
					$('.listing_selected').attr('checked', 'true');
				}

			} else {

			}
		},
		error: function (response) {},
		complete: function () {
			$('.ajax-loader').css("visibility", "hidden");
		},
	});
}

function refreshSubCategory() {
	$('#second_level').html("<option disabled>Sub Category 1</option>");
	$('#second_level').multiselect('rebuild');
	$('#third_level').html("<option disabled>Sub Category 2</option>");
	$('#third_level').multiselect('rebuild');
	$('#fourth_level').html("<option disabled>Sub Category 3</option>");
	$('#fourth_level').multiselect('rebuild');
}

function getRegistrationSubCategory(parent_key, boxid) {
	data = $('#' + parent_key).val();
	// product = $('#inlineCheckbox1').val();
	// alert(boxid);
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});

	$.ajax({
		type: "post",
		url: "/get-registration-subcategory",
		data: {
			parent_key: data,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {

			if (response) {
				console.log(response);
				// $.each(response, function(key, value) {

				//     $("#" + boxid).append('<option value="' + value['key'] + '">' + value['title'] + '</option>');

				// });
				$('#' + boxid).html(response);
				if (boxid == 'second_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#third_level').html('<option disabled>Sub Category 2</option');
					$('#third_level').multiselect('rebuild');
					$('#fourth_level').html('<option disabled>Sub Category 3</option');
					$('#fourth_level').multiselect('rebuild');
				} else if (boxid == 'third_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#fourth_level').html('<option disabled>Sub Category 3</option');
					$('#fourth_level').multiselect('rebuild');
				}
				if (boxid == 's_second_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#s_third_level').html('<option disabled>Sub Category 2</option');
					$('#s_third_level').multiselect('rebuild');
					$('#s_fourth_level').html('<option disabled>Sub Category 3</option');
					$('#s_fourth_level').multiselect('rebuild');
				} else if (boxid == 's_third_level') {
					$('#' + boxid).multiselect('rebuild');
					$('#s_fourth_level').html('<option disabled>Sub Category 3</option');
					$('#s_fourth_level').multiselect('rebuild');
				} else {
					$('#' + boxid).multiselect('rebuild');
				}

			} else {

			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
}

//Add FAQ category
$("body").on("submit", "#addFAQCategoryForm", function (e) {
	e.preventDefault();
	$.ajax({
		type: "post",
		url: "faqs-category",
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#addCategory").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {
			$("#addCategory").modal("hide");
			Swal.fire({
				// position: 'top-end',
				toast: true,
				// showConfirmButton: false,
				timer: 2000,
				icon: 'error',
				text: response.message,
			});
			setTimeout(function () {
				//  location.reload();
			}, 3000);
		},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

//end of faq category

//FAQ'S  category edit
$("body").on("click", ".edit_faq_category", function () {
	let id = $(this).attr("data-id");
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		url: "faq-category-edit",
		data: {
			id: id,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			$("#updateFaqCategoryForm .title").val(response.title);
			// if (response.type == "Product") {
			//     $('.types [value=1]').attr('selected', 'true');
			// } else if (response.type == "Service") {
			//     $('.types [value=0]').attr('selected', 'true');
			// }
			$("#updateFaqCategoryForm .title").attr(
				"data-id",
				response.id
			);
			$("#updateCategory").modal("show");

			// location.reload();
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

//end of FAQ's category edit

//update Faq Category
$("body").on("submit", "#updateFaqCategoryForm", function (e) {
	e.preventDefault();
	let id = $("#updateFaqCategoryForm .title").attr("data-id");
	$.ajax({
		type: "post",
		url: "faqs-category/" + id,
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#updateCategory").modal("hide");
				Swal.fire({
					position: 'top-end',
					toast: true,
					showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					title: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

//end of faq category


$('body').on('click', '.remove_notify', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be remove this notification!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, remove it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
						"content"
					),
				},
			});
			$.ajax({
				type: "DELETE",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					Swal.fire("Removed!", response.message, "success");
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})

$('body').on('click', '.delete_btn_detail', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
						"content"
					),
				},
			});
			$.ajax({
				type: "DELETE",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					Swal.fire("Deleted!", response.message, "success");
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						window.location.href = "/vendor-projects";
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})

$('body').on('click', '.delete_pro_detail', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
						"content"
					),
				},
			});
			$.ajax({
				type: "DELETE",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					Swal.fire("Deleted!", response.message, "success");
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						window.location.href = "/consumer-projects";
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})

$("body").on("click", ".edit_banner", function () {
	let id = $(this).attr("data-id");
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
	$.ajax({
		type: "post",
		url: "banner-edit",
		data: {
			id: id,
		},
		dataType: "json",
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.page_name == 1) {
				$('#pageName').html("Update About Us Banner <span class='text-danger'>(Banner image size:1920*366)</span>");
			} else if (response.page_name == 2) {
				$('#pageName').html("Update Services Banner <span class='text-danger'>(Banner image size:1920*366)</span>");
			} else if (response.page_name == 3) {
				$('#pageName').html("Update Plans Banner <span class='text-danger'>(Banner image size:1920*366)</span>");
			} else if (response.page_name == 4) {
				$('#pageName').html("Update Bidtalk Banner <span class='text-danger'>(Banner image size:1920*366)</span>");
			} else if (response.page_name == 5) {
				$('#pageName').html("Update Contact Us Banner <span class='text-danger'>(Banner image size:1920*366)</span>");
			}
			$("#updateBannerForm .id").attr(
				"data-id",
				response.id
			);
			$("#updateBanner").modal("show");
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

$("body").on("submit", "#updateBannerForm", function (e) {
	e.preventDefault();
	let id = $("#updateBannerForm .id").attr("data-id");
	$.ajax({
		type: "post",
		url: "bannerUpdate/" + id,
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#updateBanner").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

function img_pathUrl(input){
    $('#blah').show();
    $("#error-img").hide();
    let img = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    $('#blah')[0].src = img;
}

$("body").on("click", ".summary_view", function () {
	let title = $('#p_title').val();
	let search_for = $('input[name="search_for"]:checked').val();
	let submit_request = $('input[name="submit_request"]:checked').val();
	let payment_term = $('input[name="payment_term"]:checked').val();
	$("#paymentTerm").html(payment_term);

	var selection = [];
	$.each($("input[name='selection_base[]']:checked"), function(){
		selection.push($(this).val());
	});
	if(selection == '')
	{
		$("#selectionBase").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#selectionBase").text(selection).removeClass('text-danger');
	}

	let diversity = $('input[name="diversity[]"]:checked').map(function(){
        return $(this).val();
    }).toArray();
	
	if(diversity == '')
	{
		$("#diversityReg").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#diversityReg").text(diversity).removeClass('text-danger');
	}

	let first_level = $('#first_level option:selected').text();
	if($('#first_level').val() == undefined)
	{
		$("#cat1").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#cat1").text(first_level).removeClass('text-danger');
	}

	let second_level = $('#second_level option:selected').text();
	if($('#second_level').val() == undefined)
	{
		$("#cat2").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#cat2").text(second_level).removeClass('text-danger');
	}

	let third_level = $('#third_level option:selected').text();
	if($('#third_level').val() == undefined)
	{
		$("#cat3").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#cat3").text(third_level).removeClass('text-danger');
	}

	let fourth_level = $('#fourth_level option:selected').text();
	if($('#fourth_level').val() == undefined)
	{
		$("#cat4").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#cat4").text(fourth_level).removeClass('text-danger');
	}
	if(title == '')
	{
		$("#pro_title").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$("#pro_title").text(title).removeClass('text-danger');
	}

	let due_date_response = new Date($('#due_date_response').val());
	let location = $('#location').val();
	let licensed = $('input[name="licensed"]:checked').val();
	let frequency = $('input[name="purchase"]:checked').val();
	let description = $('.description').val();

	let files = $('.file_check').val();
	if(files != '')
	{
		let file_check = $('.file_check').map(function(){
			var customFile = $(this).prop('files')[0]; 
			if(customFile != undefined)
			{
				var name = customFile.name;
				var ext = name.split('.').pop();
			}
			return {ext:ext,customFile:customFile};
		 }).toArray();
	
		$('#theImg').html('');
		$.each(file_check, function (key, value) {
			if (value.ext == 'docx') {
				$('#theImg').append('<img id="theImg" class="mb-2" src="./frontend/assets/images/doc.png">');
			} else if (value.ext == 'doc') {
				$('#theImg').append('<img id="theImg" class="mb-2" src="./frontend/assets/images/doc.png">');
			} else if (value.ext == 'pdf') {
				$('#theImg').append('<img id="theImg" class="mb-2" src="./frontend/assets/images/pdf.png">');
			}
			else if (value.ext == 'xlsx') {
				$('#theImg').append('<img id="theImg" class="mb-2" src="./frontend/assets/images/xlsx-icon.png">');
			}
			else if (value.ext == 'pptx') {
				$('#theImg').append('<img id="theImg" class="mb-2" src="./frontend/assets/images/ppt-icon.png">');
			}
			else if (value.ext == 'png' || value.ext == 'PNG' || value.ext == 'jpg' || value.ext == 'jpeg' || value.ext == 'gif')
			{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				var form_data = new FormData();
				form_data.append("file",value.customFile);	
						
				$.ajax({
					type: "post",
					url: '/img-store',
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					data:form_data,
					success: function (response) 
					{
						$('#theImg').append('<img id="theImg" class="mb-2" src="./uploads/preview/'+response.img+'">');
						$(".img_removed").on("click", function () {
							$.ajax({
								type: "get",
								url: "/img-removed",
								data: {
									imgs : response.img
								},
								beforeSend: function () {
								},
								success: function () {
								},
							});
						});
					},
					error: function () {},
					complete: function () {
					}
				});
			}
			else
			{
				$('#theImg').html('<p class="text-danger" id="error-img">Not Selected</p>');
			}
		});
	}

	if (search_for == 0) {
		$("#search_for1").text('Services');
	} else {
		$("#search_for1").text('Products');
	}
	$("#submitted_for1").text(submit_request);
	var day = due_date_response.getDate();
	var month = due_date_response.getMonth() + 1;
	var year = due_date_response.getFullYear();
	if (due_date_response != "") {
		$("#daterespnse").text([month, day, year].join('-')).removeClass('text-danger');
	} else {
		$("#daterespnse").text('Not Selected').addClass('text-danger');
	}
	$("#lice").text(licensed);
	$("#purch").text(frequency);
	if (location != "") {
		$("#loca").text(location).removeClass('text-danger');
	} else {
		$("#loca").text('Not Selected').addClass('text-danger');
	}

	if (description != "") {
		$("#desr").text(description).removeClass('text-danger');
	} else {
		$("#desr").text('Not Selected').addClass('text-danger');
	}
	$("#summeryModal").modal("show");
});

$("body").on("submit", "#addconsumer", function () {
	$('#overlay').show();
});

function RejectStatus(id, status, passurl) {
	Swal.fire({
		title: 'Add Reason For Rejected!',
		input: 'text',
		inputAttributes: {
		  autocapitalize: 'off'
		},
		inputValidator: (value) => {
			if (!value) {
			  return 'Please Add Reason!'
			}
		},
		showCancelButton: true,
		confirmButtonText: 'Save',
		showLoaderOnConfirm: true,
		allowOutsideClick: () => !Swal.isLoading()
	  }).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "post",
				url: passurl,
				data: {
					'id': id,
					'status': status,
					'reason': result.value
				},
				dataType: "json",
				beforeSend: function () {
					$(".loader-wrapper").fadeIn("slow");
				},
				success: function (response) {
					Swal.fire("Rejected!", response.message, "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function (response) {},
				complete: function () {
					$(".loader-wrapper").fadeOut("slow");
				}
			});
		}

	});
}

function date_filter(filter)
{
	$.ajax({
		type: "get",
		url: "/date-filter",
		dataType: "json",
		data: {
			filter: filter,
		},
		beforeSend: function () {
			$('#overlay').show();
		},
		success: function (response) {
			$("#dash_table").html(response.data);
			$('#overlay').hide();
		},
	});
}

$("body").on("click", ".date_consumer_filter", function (e) {
	e.preventDefault();
	let filter = $(this).attr("data-id");
	$.ajax({
		type: "get",
		url: "/consumer-date-filter",
		dataType: "json",
		data: {
			filter:filter
		},
		beforeSend: function () {
			$('#overlay').show();
		},
		success: function (response) {
			$("#dash_table").empty().html(response.data);
			$('#overlay').hide();
		},
	});
});

$("body").on("submit", "#filter_bids", function (e) {
	e.preventDefault();
	let price = $('#price').val();
	let delivery_date = $('#delivery_date').val();
	let warranty = $('#warranty').val();
	let acceptance_criteria = $('#acceptance_criteria').val();
	let bid = $('#bid').val();
	if(!(price || acceptance_criteria || warranty || delivery_date))
	{
		return false;
	}
	$.ajax({
		type: "get",
		url: "/filter-bids",
		data: {
			'price': price,
			'delivery_date': delivery_date,
			'warranty': warranty,
			'acceptance_criteria': acceptance_criteria,
			'bid': bid
		},
		dataType: "json",
		beforeSend: function () {
			$('#overlay').show();
		},
		success: function (response) {
			$("#bidsFilter").html(response.data);
			$('#overlay').hide();
		},
	});
});

function bidtalkPostLike(id)
{
	$.ajax({
		type: "get",
		url: "bidtalk-post-like/"+id,
		dataType: "json",
		success: function (response) {
			$("#likeId_"+id).text(response.likes);
			$("#trendLikeId_"+id).text(response.likes);
			$("#todayLikeId_"+id).text(response.likes);
			$("#roomLikeId_"+id).text(response.likes);
			$("#watchLikeId_"+id).text(response.likes);
			$("#changeClass"+id).removeAttr('class');
			$('#changeClass'+id).addClass(response.addClass);
			$("#trendChangeClass"+id).removeAttr('class');
			$('#trendChangeClass'+id).addClass(response.addClass);
			$("#todayChangeClass"+id).removeAttr('class');
			$('#todayChangeClass'+id).addClass(response.addClass);
			$("#roomChangeClass"+id).removeAttr('class');
			$('#roomChangeClass'+id).addClass(response.addClass);
			$("#watchChangeClass"+id).removeAttr('class');
			$('#watchChangeClass'+id).addClass(response.addClass);
		},
	});
}

$("body").on("click", ".edit_bidpost", function () {
	let id = $(this).attr("data-id");
	$.ajax({
		type: "get",
		url: "edit_bidPost/"+id,
		dataType: "json",
		success: function (response) {
			$("#updateBidPostForm .post_text").val(response.post_text);
			$("#updateBidPostForm .post_text").attr(
				"data-id",
				response.id
			);
			$("#updateBidPost").modal("show");
		},
	});
});

$("body").on("submit", "#updateBidPostForm", function (e) {
	e.preventDefault();
	let id = $("#updateBidPostForm .post_text").attr("data-id");
	$.ajax({
		type: "post",
		url: "update_bidPost/" + id,
		data: new FormData(this),
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".loader-wrapper").fadeIn("slow");
		},
		success: function (response) {
			if (response.status == "success") {
				$("#updateBidPost").modal("hide");
				Swal.fire({
					// position: 'top-end',
					toast: true,
					// showConfirmButton: false,
					timer: 2000,
					icon: 'success',
					text: response.message,
				});
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		},
		error: function (response) {},
		complete: function () {
			$(".loader-wrapper").fadeOut("slow");
		},
	});
});

$('body').on('click', '#bidStatusAccept', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You will not be able to change this decision and all other vendor proposals will be rejected automatically!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, I'm Sure!",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "get",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					if(response.status == "error")
					{
						Swal.fire("Oops!", response.message, "error");
					}
					else
					{
						Swal.fire("Accepted!", response.message, "success");
					}
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})
$('body').on('click', '#bidStatusReject', function () {
	let id = $(this).attr("data-id");
	let url = $(this).attr("data-url");
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, I'm Sure!",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "get",
				url: url + "/" + id,
				dataType: "json",
				success: function (response) {
					Swal.fire("Rejected!", response.message, "success");
				},
				complete: function () {
					swal.hideLoading();
					setTimeout(function () {
						location.reload();
					}, 2000);
				},
				error: function () {
					swal.hideLoading();
					swal.fire(
						"!Opps ",
						"Something went wrong, try again later",
						"error"
					);
				},
			});
		}
	});
})


function subcategory(parent_key, boxid)
{
    data = $('#' + parent_key).val();
	if(data == '')
	{
		data = 0;
	}
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "post",
        url: "/fetchsubCategories",
        data: {
            parent_key: data,
        },
        dataType: "json",
        success: function(response)
		{
			$('#' + boxid).html(response);
			if (boxid == 'second_level') {
				$('#' + boxid).multiselect('rebuild');
				$('#third_level').html('<option disabled>Sub Category 2</option');
				$('#third_level').multiselect('rebuild');
				$('#fourth_level').html('<option disabled>Sub Category 3</option');
				$('#fourth_level').multiselect('rebuild');
			} else if (boxid == 'third_level') {
				$('#' + boxid).multiselect('rebuild');
				$('#fourth_level').html('<option disabled>Sub Category 3</option');
				$('#fourth_level').multiselect('rebuild');
			}
			if (boxid == 's_second_level') {
				$('#' + boxid).multiselect('rebuild');
				$('#s_third_level').html('<option disabled>Sub Category 2</option');
				$('#s_third_level').multiselect('rebuild');
				$('#s_fourth_level').html('<option disabled>Sub Category 3</option');
				$('#s_fourth_level').multiselect('rebuild');
			} else if (boxid == 's_third_level') {
				$('#' + boxid).multiselect('rebuild');
				$('#s_fourth_level').html('<option disabled>Sub Category 3</option');
				$('#s_fourth_level').multiselect('rebuild');
			}

			else
			{
				$('#' + boxid).multiselect('rebuild');
			}
			$('.listing_selected').attr('checked', 'true');
        },
    });
}

$("body").on("click", ".summary_view_register", function () {
	
	////////////-------- Product type categories --------////////////
	let first_level = $('#first_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let second_level = $('#second_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let third_level = $('#third_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let fourth_level = $('#fourth_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	if($('#first_level').val() == '')
	{
		$("#cat1").text('Not Selected').addClass('text-danger');
	}
	else
	{
		let result = "";
		result = first_level.concat(second_level,third_level,fourth_level);
		$('#cat1').text('').removeClass('text-danger');
		var array = $.map(result, function(value, index){
			
			$("#cat1").append('<span class="badge badge-secondary" style="font-size:90%;font-weight:400;">' + value + '</span>');
		});
	}

	////////////-------- Product type categories --------////////////
	let s_first_level = $('#s_first_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let s_second_level = $('#s_second_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let s_third_level = $('#s_third_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	let s_fourth_level = $('#s_fourth_level option:selected').map(function(){
        return $(this).text();
    }).toArray();
	if($('#s_first_level').val() == '')
	{
		$("#scat1").text('Not Selected').addClass('text-danger');
	}
	else
	{
		let result1 = "";
		result1 = s_first_level.concat(s_second_level,s_third_level,s_fourth_level);
		$('#scat1').text('').removeClass('text-danger');
		var array = $.map(result1, function(value, index){
			
			$("#scat1").append('<span class="badge badge-secondary" style="font-size:90%;font-weight:400;">' + value + '</span>');
		});
	}
	///////------ End products and services ------///////
	
	let first_name = $('.first_name').val();
	let last_name = $('.last_name').val();
	let email_check = $('.email_check').val();
	let phone = $('.phone').val();
	let country_id =$('#countrySelected option:selected').text();
	let state_id = $('#stateSelected option:selected').text();
	let zip_code = $('.zip_code').val();
	let address = $('.address').val();
	let bidder_name = $('.bidder_name').val();
	let bidder_website = $('.bidder_website').val();
	let bidder_category = $("input[name='bidder_category']:checked").data('name');
	let article = $('.article').val();
	let tax_info = $('.tax_info').val();
	let dunn_no = $('.dunn_no').val();
	let insurance_coverage = $("input[name='insurance_coverage']:checked").data('name');
	let diversity = $('input[name="diversity[]"]:checked').map(function(){
        return $(this).val();
    }).toArray();
	
	if(diversity == '')
	{
		$(".d_r_status").text('Not Selected').addClass('text-danger');
	}
	else
	{
		$(".d_r_status").text(diversity).removeClass('text-danger');
	}

	let payment_term = $("input[name='payment_term']:checked").data('name');
	let tier1 = $("input[name='pro[]']:checked").val();

	let customFile = $('.customFile00').val();
	let ext = customFile.split('.').pop();

	if (first_name != "") {
		$("#sfirst_name").text(first_name).removeClass('text-danger');
	} else {
		$("#sfirst_name").text('Not Selected').addClass('text-danger');
	}
	if (last_name != "") {
		$("#slast_name").text(last_name).removeClass('text-danger');
	} else {
		$("#slast_name").text('Not Selected').addClass('text-danger');
	}
	if (email_check != "") {
		$("#semail_check").text(email_check).removeClass('text-danger');
	} else {
		$("#semail_check").text('Not Selected').addClass('text-danger');
	}
	if (phone != "") {
		$("#sphone").text(phone).removeClass('text-danger');
	} else {
		$("#sphone").text('Not Selected').addClass('text-danger');
	}
	if (country_id != "") {
		$("#scountry_id").text(country_id).removeClass('text-danger');
	} else {
		$("#scountry_id").text('Not Selected').addClass('text-danger');
	}
	if (state_id != "") {
		$("#sstate_id").text(state_id).removeClass('text-danger');
	} else {
		$("#sstate_id").text('Not Selected').addClass('text-danger');
	}
	if (zip_code != "") {
		$("#szip_code").text(zip_code).removeClass('text-danger');
	} else {
		$("#szip_code").text('Not Selected').addClass('text-danger');
	}
	if (address != "") {
		$("#saddress").text(address).removeClass('text-danger');
	} else {
		$("#saddress").text('Not Selected').addClass('text-danger');
	}
	if (bidder_name != "") {
		$("#sbidder_name").text(bidder_name).removeClass('text-danger');
	} else {
		$("#sbidder_name").text('Not Selected').addClass('text-danger');
	}
	if (bidder_website != "") {
		$("#sbidder_website").text(bidder_website).removeClass('text-danger');
	} else {
		$("#sbidder_website").text('Not Selected').addClass('text-danger');
	}
	if (bidder_category != undefined) {
		$("#sbidder_category").text(bidder_category).removeClass('text-danger');
	} else {
		$("#sbidder_category").text('Not Selected').addClass('text-danger');
	}
	if (article != "") {
		$("#sarticle").text(article).removeClass('text-danger');
	} else {
		$("#sarticle").text('Not Selected').addClass('text-danger');
	}
	if (tax_info != "") {
		$("#stax_info").text(tax_info).removeClass('text-danger');
	} else {
		$("#stax_info").text('Not Selected').addClass('text-danger');
	}
	if (dunn_no != "") {
		$("#sdunn_no").text(dunn_no).removeClass('text-danger');
	} else {
		$("#sdunn_no").text('Not Selected').addClass('text-danger');
	}
	if (insurance_coverage != undefined) {
		$("#sinsurance_coverage").text(insurance_coverage).removeClass('text-danger');
	} else {
		$("#sinsurance_coverage").text('Not Selected').addClass('text-danger');
	}
	if (payment_term != undefined) {
		$("#spayment_term").text(payment_term).removeClass('text-danger');
	} else {
		$("#spayment_term").text('Not Selected').addClass('text-danger');
	}
	if (tier1 != "") {
		$("#stier1").text(tier1).removeClass('text-danger');
	} else {
		$("#stier1").text('Not Selected').addClass('text-danger');
	}


	if (ext == 'docx') {
		$('#theImg').html('<img id="theImg" src="./frontend/assets/images/doc.png">');
	} else if (ext == 'doc') {
		$('#theImg').html('<img id="theImg" src="./frontend/assets/images/doc.png">');
	} else if (ext == 'pdf') {
		$('#theImg').html('<img id="theImg" src="./frontend/assets/images/pdf.png">');
	}
	else if (ext == 'xlsx') {
		$('#theImg').html('<img id="theImg" src="./frontend/assets/images/xlsx-icon.png">');
	}
	else if (ext == 'pptx') {
		$('#theImg').html('<img id="theImg" src="./frontend/assets/images/ppt-icon.png">');
	}
	else if (ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'gif') {


	}
	$("#summeryModal").modal("show");
});


$('body').on('change', '.pros', function () {
    if($(".pros option:selected").length > 9) {
    //  $('option:not(:selected)',this).prop('disabled',true);
     $('.pros .dropdown-item').addClass('disabled');
	 $('.active').removeClass('disabled');
	 Swal.fire({
		icon: 'info',
		title: 'Oops...',
		timer: 2000,
		text: 'You can not select up to 10 products!',
	});
  }
  else
  {
	$('.pros .dropdown-item').removeClass('disabled');
  }
});

$('body').on('change', '.serv', function () {
    if($(".serv option:selected").length > 9) {
     $('.serv .dropdown-item').addClass('disabled');
	 $('.active').removeClass('disabled');
	 Swal.fire({
		icon: 'info',
		title: 'Oops...',
		timer: 2000,
		text: 'You can not select up to 10 services!',
	});
  }
  else
  {
	$('.serv .dropdown-item').removeClass('disabled');
  }
});

var btn = $('#buttonTop');

$(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});

$("body").on("submit", "#filter_proposal", function (e) {
	e.preventDefault();
	let payment_terms = $('#payment_terms').val();
	let selection_base = $('#selection_base').val();
	let diversity_status = $('#diversity_status').val();
	
	if(!(payment_terms || selection_base || diversity_status))
	{
		return false;
	}
	$.ajax({
		type: "get",
		url: "/filter-proposal",
		data: {
			'payment_terms': payment_terms,
			'selection_base': selection_base,
			'diversity_status': diversity_status
		},
		dataType: "json",
		beforeSend: function () {
			$('#overlay').show();
		},
		success: function (response) {
			$("#proposalLoad").html(response.data);
			$('#overlay').hide();
		},
	});
});