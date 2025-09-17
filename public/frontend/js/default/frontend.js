"use strict";

/** Global Variables */
const dynamicModalContent = $(".dynamic-modal .modal-content");

/** Template Variables */
const loader = `
<div class="d-flex justify-content-center align-items:center p-3">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>`;

/** Functions */

/** Image preview function
 * @param {object} input
 * @param {string} selector
 * @param {function} callback
 */
function previewImage({ input, selector = null, callback }) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            if (selector) {
                $(selector).attr("src", e.target.result);
            }
            callback(e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/** Show dynamic modal
 * @param {string} url
 */
function showDynamicModal(url) {
    $.ajax({
        method: "GET",
        url: url,
        beforeSend: function () {
            $(".modal-content").html(loader);
        },
        success: function (data) {
            $(".modal-content").html(data);
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                orientation: "bottom auto",
            });
        },
        error: function (xhr, status, error) {},
    });
}

/** get and set location
 * @param {string} url
 * @param {string} selector
 */
function getLocation(url, selector) {
    $.ajax({
        method: "GET",
        url: url,
        beforeSend: function () {
            $.ajax({
                method: "GET",
                url: url,
                beforeSend: function () {
                    $(selector).html(`<option value="">Loading...</option>`);
                },
                success: function (data) {
                    $(selector).html(`<option value="">Select</option>`);
                    $.each(data, function (key, value) {
                        $(selector).append(
                            `<option value="${value.id}">${value.name}</option>`
                        );
                    });
                },
                error: function (xhr, status, error) {
                    $(selector).html(`<option value="">Select</option>`);
                },
            });
        },
    });
}

/**
 * Scroll to an element.
 *
 * @param {string} selector - jQuery selector for the element to scroll to.
 */
function scrollToElement(selector) {
    var $element = $(selector);
    if ($element.length)
        $("html, body").animate({ scrollTop: $element.offset().top }, 300);
}

/** On DOM load */
$(document).ready(function () {
    $(".logout-btn").on("click", function (e) {
        e.preventDefault();
        $("#logout-form").trigger("submit");
    });

    $("#cover-img").change(function () {
        previewImage({
            input: this,
            callback: function (path) {
                $(".preview-cover-img").css(
                    "background-image",
                    "url(" + path + ")"
                );
            },
        });
    });

    $("#avatar").change(function () {
        previewImage({ input: this, selector: ".preview-avatar" });
    });

    /** Show dynamic modal */
    $(".show-modal").on("click", function (e) {
        e.preventDefault();
        $(".dynamic-modal").modal("show");
        let url = $(this).attr("data-url");
        showDynamicModal(url);
    });

    /** Delete item */
    $(".delete-item").on("click", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function () {},
                    success: function (data) {
                        if (data.status == "success") {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success",
                            });
                            location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        toastr.error(error);
                    },
                });
            }
        });
    });

    /*************************************************
     * Become Instructor page js Start
     *************************************************/

    /** payout account change */
    $("#payout_account").on("change", function () {
        let value = $(this).val();
        $(".payment_info_wrap").removeClass("d-none");
        $(".payment-info").addClass("d-none");
        $(`.payment-${value}`).removeClass("d-none");
    });

    /*************************************************
     * Become Instructor page js End
     *************************************************/

    /** Change Currency */
    $(".change-currency").on("change", function (e) {
        $(".set-currency-header").trigger("submit");
    });
    $(".set-currency-header-mobile").on("change", function (e) {
        $(".change-currency-header-mobile").trigger("submit");
    });

    // submit language form
    $("#setLanguageHeader").on("change", function (e) {
        $(this).trigger("submit");
    });

    $(".set-language-header-mobile").on("change", function (e) {
        $(".change-language-header-mobile").trigger("submit");
    });

    /** Newsletter Form */
    $(".newsletter").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            method: "POST",
            url: base_url + "/newsletter-request",
            data: formData,
            beforeSend: function () {
                $(".newsletter button").text(submitting);
                $(".newsletter button").prop("disabled", true);
            },
            success: function (data) {
                toastr.success(data.message);
                $(".newsletter button").text(subscribe_now);
                $(".newsletter button").prop("disabled", false);
                $(".newsletter")[0].reset();
            },
            error: function (xhr, status, error) {
                let messages = xhr.responseJSON.message;
                $.each(messages, function (key, value) {
                    toastr.error(value);
                });
                $(".newsletter button").text(subscribe_now);
                $(".newsletter button").prop("disabled", false);
            },
        });
    });

    /** handle contact form */
    $("#contact-form").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            method: "POST",
            url: base_url + "/contact/send-mail",
            data: formData,
            beforeSend: function () {
                $("#contact-form button").text(submitting);
                $("#contact-form button").prop("disabled", true);
            },
            success: function (data) {
                toastr.success(data.message);
                $("#contact-form")[0].reset();
                $("#contact-form button").text(subscribe_now);
                $("#contact-form button").prop("disabled", false);
                window.location.reload();
            },
            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    toastr.error(value);
                });
                $("#contact-form button").text(subscribe_now);
                $("#contact-form button").prop("disabled", false);
            },
        });
    });

    /** Show course delete request Modal*/
    $(".course-delete-request").on("click", function (e) {
        e.preventDefault();
        $(".dynamic-modal").modal("show");
        let url = $(this).attr("href");
        showDynamicModal(url);
    });

    $(".select2").select2();

    //wishlist method
    $(document).on("click", ".wsus-wishlist-btn", function (e) {
        e.preventDefault();
        const slug = $(this).data("slug");
        let csrf_token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: `${base_url}/wishlist/${slug}`,
            type: "GET",
            dataType: "json",
            data: {
                _token: csrf_token,
            },
            beforeSend: function () {
                $(`a[data-slug="${slug}"]`).find("i").toggleClass("fas far");
            },
            success: (response) => {
                if (response.status == "added") {
                    toastr.success(response.message);
                } else {
                    toastr.info(response.message);
                }
            },
            error: function (xhr, status, error) {
                $(`a[data-slug="${slug}"]`).find("i").toggleClass("fas far");
                if (xhr.status == 401) {
                    toastr.error(login_first);
                } else {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            },
        });
    });

    //wishlist method
    $(document).on("click", ".wsus-wishlist-remove", function (e) {
        e.preventDefault();
        const slug = $(this).data("slug");
        let csrf_token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `${base_url}/wishlist/${slug}`,
            type: "DELETE",
            dataType: "json",
            data: {
                _token: csrf_token,
            },
            beforeSend: function () {
                $(".preloader-two").removeClass("d-none");
            },
            success: (response) => {
                if (response.status == "success") {
                    $(".wishlist-content").html(response.content);
                } else {
                    toastr.warning(response.message);
                }
            },
            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    toastr.error(value);
                });
            },
            complete: function(){
                $(".preloader-two").addClass("d-none");
            }
        });
    });

    // Handle Start Learning button click
    $(document).on('click', '.start-learning-btn', function(e) {
        e.preventDefault();
        
        const courseId = $(this).data('id');
        const button = $(this);
        const originalText = button.find('.text').text();
        
        if (!courseId) {
            toastr.error('Course ID not found');
            return;
        }
        
        // Show loading state
        button.prop('disabled', true);
        button.find('.text').text('Enrolling...');
        
        // Get CSRF token
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // Make AJAX request to enroll user
        $.ajax({
            url: `${base_url}/student/enroll-course`,
            type: 'POST',
            data: {
                course_id: courseId,
                _token: csrfToken
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message || 'Successfully enrolled in course!');
                    
                    // Redirect to learning page
                    if (response.learning_url) {
                        window.location.href = response.learning_url;
                    } else {
                        // Fallback: redirect to enrolled courses
                        window.location.href = `${base_url}/student/enrolled-courses`;
                    }
                } else {
                    toastr.error(response.message || 'Failed to enroll in course');
                    // Reset button state
                    button.prop('disabled', false);
                    button.find('.text').text(originalText);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 401) {
                    toastr.error('Please login first to enroll in courses');
                    // Redirect to login page
                    window.location.href = `${base_url}/login`;
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error('An error occurred while enrolling. Please try again.');
                }
                
                // Reset button state
                button.prop('disabled', false);
                button.find('.text').text(originalText);
            }
        });
    });


    if (window.self !== window.top) {
        $('#iframeModal').modal('show');
    }
});
