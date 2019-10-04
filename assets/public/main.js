
(function ($) {

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })

    /*==================================================================
    [ Validate ]*/
    var input       = $('.validate-input .input100');
    var checkbox    = $('.checkbox');
    $('.validate-form').on('submit',function(){
        var isChecked   = $('.checkbox').is(':checked');
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        if (check) {
            if (!isChecked) {
                showValidate(checkbox);
                check = false;
                return check;
            }
        }else{
            return check;
        }
    });
    $('.checkbox').click(function(){
        hideValidate(this);
    });
    
    $('.btn-file').click(function(){
        hideValidate(this);
    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

})(jQuery);

(function() {
    $("#success").modal("show")
    var clipboard = new ClipboardJS('#copy');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
})();

$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),

        log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });

    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {
    //             $('#img-upload').attr('src', e.target.result);
    //         }

    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

    // $("#imgInp").change(function(){
    //     readURL(this);
    // });
});
/*(function ($) {

    function removeTag(){
        var child = document.getElementById("media_image-3");
        child.parentNode.removeChild(child);
    }

    function getImage() {
        var img = document.querySelectorAll("#media_image-3 img");
        var src = img[0].getAttribute("src");
        return src;
    }

    function changeLogo(){
        var a       = document.getElementsByClassName("logo");
        var img_src = getImage();
        var img;
        for (var i = 0; i < a.length; i++) {
            a[i].setAttribute("href", "http://himatika.fst.uinjkt.ac.id/parsial2019/");
            img = a[i].firstChild;
            img.setAttribute("src", img_src);
        }
    }
    function changeSocial() {
        var footer = document.querySelectorAll(".footer-social a");
        var top = document.querySelectorAll("#top-nav a");
        var link = "https://www.instagram.com/parsialhimatika.uinjkt/";
        footer[footer.length-1].setAttribute("href", link);
        top[top.length-1].setAttribute("href", link);
    }
    function changeStyle(argument) {
        var style = '<style type="text/css">.main-color-1-bg,.main-color-1-bg-hover:hover,.navbar-inverse .navbar-nav>li>a:after,.navbar-inverse .navbar-nav>li>a:focus:after{background-color : #083a06;}.main-color-2-bg {background-color: #172f21;}</style>';
        $(style).appendTo('head');
    }

    var url = window.location.href;
    var parsial_url = "himatika.fst.uinjkt.ac.id/parsial2019/";
    if (url.search(parsial_url) > 0) {
        changeLogo();
        changeSocial();
        changeStyle();
    }
    removeTag();
})(jQuery);

(function ($) {

    var url = window.location.href;
    var parsial_url = "himatika.fst.uinjkt.ac.id/parsial2019/";
    if (url.search(parsial_url) > 0) {
        var style = '<style type="text/css">.main-color-1-bg,.main-color-1-bg-hover:hover,.navbar-inverse .navbar-nav>li>a:after,.navbar-inverse .navbar-nav>li>a:focus:after{background-color : #083a06;}.main-color-2-bg {background-color: #172f21;}</style>';
        $(style).appendTo('head');
    }

})(jQuery);

// .main-color-1-bg,
// .main-color-1-bg-hover:hover,
// .navbar-inverse .navbar-nav>li>a:after,
// .navbar-inverse .navbar-nav>li>a:focus:after{
//     background-color : #083a06;
// }
// .main-color-2-bg {
//     background-color: #172f21;
// }

    var color1 = "#083a06";
    var color2 = "#172f21";
    var bg = "background-color";
    $(".main-color-1-bg").css(bg, color1);
    $(".main-color-2-bg").css(bg, color2);
    $(".main-color-1-bg-hover").hover(function() {
        $(this).css(bg, color1);
    });
    $(".navbar-inverse .navbar-nav>li>a").after(function() {
        $(this).css(bg, color1);
    });
    $(".navbar-inverse .navbar-nav>li>a:after");
    $(".navbar-inverse .navbar-nav>li>a").after().css(bg, color1);
    
    $(".main-color-1-bg-hover").hover(function(){
        $(this).css(bg, color1);
    });

    $(".main-color-1-bg").addClass(".main-color-1-bg-parsial");
    $(".main-color-2-bg").addClass(".main-color-2-bg-parsial");
    $(".main-color-1-bg-hover").addClass(".main-color-1-bg-hover-parsial");
    $(".navbar-inverse .navbar-nav").addClass(".navbar-nav-parsial");

*/