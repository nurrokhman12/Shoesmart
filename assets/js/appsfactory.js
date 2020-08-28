
$(document).ready(function(){
    $("#notice").removeClass().addClass('alert-success').text('Masukkan username dan password Anda.').fadeIn(1000);
    $("#submitlogin").bind('click',function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var actionfile = "../modules/auth.php?username=" + username + "&password=" + password + "";
        $("#notice").removeClass().addClass('alert-info').text('Processing Login...').fadeIn(1000);
        $.getJSON(actionfile, function(data){
            var response = data.authresult;
            var message = data.authmessage;
            if(response=="authorised"){
                $("#notice").fadeTo(200,0.1,function(){
                    $(this).html(''+message+'...').removeClass().addClass('alert-success').fadeTo(900,1,function(){
                        document.location='./';
                    });
                });
            }else{
                $("#notice").fadeTo(200,0.1,function(){
                    $(this).html(''+message+'').removeClass().addClass('alert-error').fadeTo(900,1);
                    $("form#login")[0].reset();
                });
            }
        });
        return false;
    });
    /* sample implementation onKeyPress number formatting => */
    /*
    $('#myinput').live('keyup', function(){
        $(this).val(formatnumberotf.call($(this).val().split(' ').join(''),' ','.'));
    }); */
});