(function($) {
    "use strict";
    //mega-menu basicform submit
    $("#basicform").on('submit', function(e) {
        e.preventDefault();
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').attr('disabled', '');
            },
            success: function(response) {
                window.location.reload();
                $('.basicbtn').removeAttr('disabled');
                alert('success', response);
                success(response)
            },
            error: function(xhr, status, error) {
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });
    $(".basicform").on('submit', function(e) {
        e.preventDefault();

        var instance = $('.content').val()
        if (instance != null) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                //alert('ok')
                $('.basicbtn').removeAttr('disabled')
                if (response.error) {
                    alert('error', response.error)
                } else {
                    if (response.message) {
                        alert('success', response.message);
                    }
                    if (response.url) {
                        window.location.href = response.url;
                    }
                    else {
                        window.location.reload()

                    }
                }
                $('.basicbtn').html(basicbtnhtml);
                // window.location.reload()
                //success(response);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                if(xhr.status !== 500) {

                    $.each(xhr.responseJSON.errors, function(key, item) {
                        alert('error', item)
                        $("#errors").html("<li class='text-danger'>" + item + "</li>")
                    });
                }
                else {
                    alert('error', xhr.responseJSON.message);

                }
                //errosresponse(xhr, status, error);
            }
        })
    });
    $(".basicform_with_reload").on('submit', function(e) {
        e.preventDefault();

        var instance = $('.content').val()
        if (instance != null) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                alert('success', response);
                $('.basicbtn').html(basicbtnhtml);
                if (response.error) {
                    alert('error', response.error)
                } else {
                    if (response.message) {
                        alert('success', response.message);
                    }
                    if (response.url) {
                        window.location.href = response.url;
                    }
                    else {
                        location.reload();
                    }
                }
                // location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseJSON.errors)
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                // errosresponse(xhr, status, error);
            }
        })
    });
    $(".basicform_with_reset").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                if (response.error) {
                    alert('error', response.error)
                } else {
					if(response.message) {

						alert('success', response.message);
						window.location.href = response.url;
					}
					else {
						alert('success', response);

					}
                }
                $('.basicbtn').html(basicbtnhtml);
                $('.basicform_with_reset').trigger('reset');
                //window.history.back();
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                //errosresponse(xhr, status, error);
            }
        })
    });
    $(".basicform_with_remove").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                alert('success', response);
                $('.basicbtn').html(basicbtnhtml);
                $('input[name="ids[]"]:checked').each(function(i) {
                    var ids = $(this).val();
                    $('#row' + ids).remove();
                });
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });
    $(".loginform").on('submit', function(e) {
        response = grecaptcha.getResponse();
        if (response.length === 0) {
        jQuery('#g-recaptchaError').text('The g-recaptcha-response field is required.');
        return;
     }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                $('.basicbtn').html(basicbtnhtml);
                location.reload();
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });
    //id basicform1 when submit 
    $("#basicform1").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                success(response)
            },
            error: function(xhr, status, error) {
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    alert('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });
    $(".checkAll").on('click', function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $(".cancel").on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do It!'
        }).then((result) => {
            if (result.value == true) {
                window.location.href = link;
            }
        })
    });

    function alert(icon, title, time = 3000) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: time,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: icon,
            title: title,
        })
    }
})(jQuery);

function copyUrl(id) {
    var copyText = document.getElementById("myUrl" + id);
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert('success', 'Link copied to clipboard.');
}

function checkPermissionByGroup(className, checkThis) {
    const groupIdName = $("#" + checkThis.id);
    const classCheckBox = $('.' + className + ' input');
    if (groupIdName.is(':checked')) {
        classCheckBox.prop('checked', true);
    } else {
        classCheckBox.prop('checked', false);
    }
}
updateArray = [];
if($('#sortable').length > 0) {

    myList = $('#sortable');
    $(() => {
        myList.sortable({
            stop: function(event, ui) {
                updateArray = $("#sortable").sortable("toArray", { attribute: 'photoID' });
                $('#array').html(updateArray.join(', '));
            }
        });
        updateArray = $("#sortable").sortable("toArray", { attribute: 'photoID' });
     
        myList.disableSelection();
    });
    
    
    updateArray = [];
    myList = $('#sortable');
}

$(document).on('click', '.update-image-order', function(e) {

    $.ajax({
        type: 'post',
        url: $(this).attr('data-action'),
        data: { images: updateArray, 'alt_data': $('.image_sort').serializeArray() },
        datatType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            alert('success', response.message)
        },
        error: function(error) {
            alert('error', error.message)
        }
    });
});
$(document).on('change', '.export-select-box', function(e) {
 
    if($(this).val() != '') {

        window.location.href = $(this).val()
    }
});

$(document).on('change', '.export-select-box-report', function(e) {

if($(this).val() != '') {
    $('.report-form').attr('action', $(this).val())
    $('.report-form').submit()
}
   
});

$(".delete").on('click', function(e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Do It!'
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                type: 'DELETE',
                url: link,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.error) {
                        alert('error', response.error)
                    } else {
                        if(response.message) {
    
                            alert('success', response.message);
                            if( response.url) {

                                window.location.href = response.url;
                            }
                            else {
                                window.location.reload()
                            }
                        }
                        else {
                            alert('success', response);
    
                        }
                    }
                },
                error: function(xhr, status, error) {
                  
                }
            })
        }
    })
});


// function copyToClipboard(element) {
//     var $temp = $("<input>");
//     $("body").append($temp);
//     $temp.val($(element).text()).select();
//     document.execCommand("copy");
//     $temp.remove();
//     alert('success', 'Copy Message')
//   }

  $(document).on('click', '.copy-message-button', function(e){
      var element = $(this).attr('data-target')
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    alert('success', 'Copy Message')
  })
if($('.seo_description').lenght > 0) {

    CKEDITOR.replace( 'seo_description' );
}




  $(".update-basicform_with_reload").on('submit', function(e) {
    e.preventDefault();

    var instance = $('.content').val()
    if (instance != null) {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    }

    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var basicbtnhtml = $('.basicbtn').html();
    $.ajax({
        type: 'PUT',
        url: this.action,
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.basicbtn').html("Please Wait....");
            $('.basicbtn').attr('disabled', '')
        },
        success: function(response) {
            $('.basicbtn').removeAttr('disabled')
            alert('success', response);
            $('.basicbtn').html(basicbtnhtml);
            if (response.error) {
                alert('error', response.error)
            } else {
                if (response.message) {
                    alert('success', response.message);
                }
                if (response.url) {
                    window.location.href = response.url;
                }
                else {
                    location.reload();
                }
            }
            // location.reload();
        },
        error: function(xhr, status, error) {
            $('.basicbtn').html(basicbtnhtml);
            $('.basicbtn').removeAttr('disabled')
            $('.errorarea').show();
            $.each(xhr.responseJSON.errors, function(key, item) {
                alert('error', item)
                $("#errors").html("<li class='text-danger'>" + item + "</li>")
            });
            // errosresponse(xhr, status, error);
        }
    })
});

$(document).on('change', '#table-limit', function(e){
    $('#'+$(this).attr('form')).submit()
});