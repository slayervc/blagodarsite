$(function() {

$().

registerFormMessage

// листалка по стр
 if ($("body").has(".alert-danger") == true){


  
        var elementClick = $((".alert-danger");
        var destination = $(elementClick).offset().top;
        
            $('html, body').animate({ scrollTop: destination }, 1100);
    
 }
})