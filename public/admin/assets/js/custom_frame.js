
$( document ).ready(function() {
   // alert();
});
$(document).on('click', '.data-delete', function(e) {
    e.preventDefault();
    var deleteLinkUrl = $(this).attr('delete-link');
    //var deleteLinkUrl = $(this).attr('href')
    //alert(deleteLinkUrl);
    var dataType = ($(this).attr('data-type')) ? $(this).attr('data-type') : 'html';
    // alert(dataType);
    var callBack = ($(this).attr('callback')) ? $(this).attr('callback') : false;
   // alert(callBack);
    var csrf = $(this).find("input[name='_token']").val();
  //  alert(csrf);
  //Swal.fire(`Your IP address is`)
//   alert();
Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if (result.value) {
        // form.submit();
        $.ajax({
            url : deleteLinkUrl,
            type: "POST",
            data: {"_token": csrf, '_method':'DELETE'}, 
            dataType: dataType,
            success:function(data){
                //alert(data);
                //location.reload();
                
                var dataError = (dataType=="html") ? data.trim() : data.error;
                    if((typeof dataError!==typeof undefined) && (dataError)) {
                        Swal.fire({
                            title: "Oops...",
                            text: dataError,
                            confirmButtonColor: "#EF5350",
                            type: "error"
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: "This data has been deleted!",
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        }).then(function() {
                                // Swal.close();
                               location.reload();
                            });
                    }
            }
       });     
    } else {
        Swal.fire({
            title: "Cancelled",
            text: "Your imaginary file is safe :)",
            confirmButtonColor: "#2196F3",
            type: "error"
        });
    }
});
})

$(document).on('click', '.data-list #decisionMake', function(e) {
    e.preventDefault();
    var decisionLinkUrl = $(this).attr('decision-link');
    var alertText = $(this).attr('alert-text');
    var confirmBtnText = $(this).attr('confirmBtn-text');
    var csrf = $(this).find("input[name='_token']").val();
    Swal({
        title: "Are you sure?",
        text: alertText,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: confirmBtnText,
        closeOnCancel: false
    }, 
    function(isConfirm){
        if (isConfirm) {
            
            $.ajax({
                url : decisionLinkUrl,
                type: "POST",
                data: {"_token": csrf, '_method':'POST'}, 
                dataType: 'json',
                success:function(response){
                    let msgType = response.msgType;
                    let messege = response.messege;
                    if (msgType == 'danger') {
                        Swal({
                            title: "Opps!!",
                            text: messege,
                            confirmButtonColor: "#EF5350",
                            type: "error"
                        });
                    } else {
                        Swal({
                            title: "Done!",
                            text: messege,
                            confirmButtonColor: "#66BB6A",
                            type: 'success'
                        },function(isConfirm) {
                            if (isConfirm == true) {
                                // Swal.close();
                                location.reload();
                            }
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal({
                        title: "Opps!!",
                        text: "Seems you couldn't submit form for a longtime. Please refresh your form & try again",
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });
                }
            });
        } else {
            Swal({
                title: "Cancelled",
                text: "Your imaginary decision is safe :)",
                confirmButtonColor: "#2196F3",
                type: "error"
            });
        }
    });
})


$(document).on('click', '.open-modal', function(e) {

    e.preventDefault();
    var modalTitle = $(this).attr('modal-title');
    var modalType = $(this).attr('modal-type');
    var modalSize = $(this).attr('modal-size');
    var className = $(this).attr('modal-class');
    // var url = $(this).attr('modal-link');
    var url = $(this).attr('href');
    var selector =$(this).attr('selector');
    //alert(modalTitle);
    if (modalType=="create") {
        var successButton = "Save";
    } else if (modalType=="update") {
        var successButton = "Update";
    }
    $.ajax({
        url: url,
        type: 'GET',
        dataType: "html",
        success: function(response) {
            if (modalType!="show") {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-default"
                        },
                        success: {
                            label: successButton,
                            className: "btn-success disable-on-click",
                            "callback": function() {
                                $("#" + selector + " form").submit();
                                return false;
                            }
                        }
                    }
                }); 
            } else {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-default"
                        }
                    }
                }); 
            }
            $("#"+selector).html(response);
            $("#submit_btn").removeAttr("disabled", "disabled"); 
        }
    });
        
})
$(document).on('click', '.modal-anywhere .open-modal', function(e) {

    e.preventDefault();
    var modalTitle = $(this).attr('modal-title');
    var modalType = $(this).attr('modal-type');
    var modalSize = $(this).attr('modal-size');
    var className = $(this).attr('modal-class');
    var url = $(this).attr('modal-link');
    var selector =$(this).attr('selector');
    
    if (modalType=="create") {
        var successButton = "Save";
    } else if (modalType=="update") {
        var successButton = "Update";
    }
    $.ajax({
        url: url,
        type: 'GET',
        dataType: "html",
        success: function(response) {
            if (modalType!="show") {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-default"
                        },
                        success: {
                            label: successButton,
                            className: "btn-success disable-on-click",
                            "callback": function() {
                                $("#" + selector + " form").submit();
                                return false;
                            }
                        }
                    }
                }); 
            } else {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-default"
                        }
                    }
                }); 
            }
            $("#"+selector).html(response);
            $("#submit_btn").removeAttr("disabled", "disabled"); 
        }
    });
        
})

$('#custom_file_preview').on('click', '#custom_close', function() {
    $('#custom_file_preview').remove();
    $('#custom_file_input').show();
});

$('.upload-attachment a').on('click', function (event) {
    event.preventDefault();
    let openLink = $(this).attr('href');
    window.open(openLink, '_blank');
})

function redirectLoginPage(userType) {
    Swal({
        title: "Sorry!!",
        text: "You have logged out.",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: "Login Now!",
        closeOnConfirm: false
    },
    function(){
        if (userType === 'student') {
            location.replace('login');
        } else if(userType === 'teacher') {
            location.replace('teacher/login');
        } else if(userType === 'support') {
            location.replace('support/login');
        } else if(userType === 'provider') {
            location.replace('provider/login');
        }
    });
}


// FRAME START
var urlSeparatorDataTable = "~";
function loadDataTable(selector) {
    let loadUrl = (selector.find('.panel-laod').attr('load-url')) ? selector.find('.panel-laod').attr('load-url') : false;
    let inputArray = {};

    if(loadUrl) {
        let that = selector;
        selector.find(".data-list")
            //Pagination
            .on('click', ".pagination li a", function(e) {
                e.preventDefault();
                var paginateUrl = $(this).attr("href");
                var paginateUrl = paginateUrl.split("page=");
                var page = (paginateUrl.length==2) ? paginateUrl[1] : "";
                inputArray["page"] = page;
                loadAjaxContentData(that, loadUrl, inputArray);
            })//PerPage
            .on('change', "#perPage", function(e) {
                e.preventDefault();
                var perPage = $(this).val();
                inputArray["perPage"] = perPage;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
            })//AscDesc
            .on('click', ".data-sorting", function(e) {
                e.preventDefault();
                
            })//select filtering
            .on('change', ".data-search", function(e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).val();
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            })//search Data
            .on('enter', ".data-search", function(e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).val();
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            })
            .on('click', ".table_filter_button button", function(e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).attr('sortId');
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            })


        loadAjaxContentData(that, loadUrl, inputArray);
    }
}

function loadAjaxContentData(that, loadUrl, inputArray) {

    // preLoader(that);
    $.ajax({
        mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
        url: loadUrl,
        data: inputArray,
        type: 'GET',
        dataType: "html",
        success: function(response) {
            if(parseInt(response)===0) {
                redirectLoginPage('provider');
            } else {
                preLoaderHide(that);
                that.find(".data-list").html(response);
            }
        }
    });
}

function preLoader(that) {
    that.find('.data-list').html(`<div class="theme_perspective preloader"><div class="pace_activity"></div><div class="pace_activity"></div><div class="pace_activity"></div><div class="pace_activity"></div></div>`);
}

function preLoaderHide(that) {
    that.find('.preloader').hide();
}
