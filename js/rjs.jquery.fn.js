//non angular javascript code
jQuery(function ($) {
    //@sftodo tie this into tabs as well.
    /*if (window.location.hash) {
     var hash = window.location.hash;
     $(hash).modal('toggle');
     }*/
    // Javascript to enable link to tab
    var hash = document.location.hash;
    var prefix = "tab_";
    if (hash) {
        $('.nav-tabs a[href=' + hash.replace(prefix, "") + ']').tab('show');
    }
    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function (e) {
        window.location.hash = e.target.hash.replace("#", "#" + prefix);
    });
    $('#container').on('click', '.rjs-submit-form', function (e) {
        e.preventDefault();
        var d = $('form.rjs-form').serializeArray();
        console.log(d);
        jQuery.ajax({
            type: 'POST',
            url: wfcLocalized.ajax_url,
            data: {
                action: 'rjs_edit_form',
                postdata: d,
                postid: 547
            },
            success: function (response) {
                console.log(response);
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                alert("An error has occurred. Please try again.");
                console.log(errorThrown);
            }
        });
    });
/*    $('#container').on('click', '.rjs-create-submit-form', function (e) {
        e.preventDefault();
        var d = $('form.rjs-create-form').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: wfcLocalized.ajax_url,
            data: {
                action: 'rjs_create_form',
                posttype: "wfc_trucks",
                postdata: d
            },
            success: function (response) {
                console.log(response);
                $('#newPost').modal('hide')
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });*/
    //jQuery.ajax({
    //        type: 'POST',
    //        url: wfcLocalized.ajax_url,
    //        data: {
    //            action: 'rjs_edit_form',
    //            postdata: "steve",
    //            postid: 605
    //        },
    //        success: function (response) {
    //            console.log(response);
    //
    //        },
    //        error: function (MLHttpRequest, textStatus, errorThrown) {
    //            alert(errorThrown);
    //        }
    //    });
});