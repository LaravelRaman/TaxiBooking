$(function() {
        
    /*------------------------------------------
    --------------------------------------------
    Submit Event
    --------------------------------------------
    --------------------------------------------*/
    $("#handleAjax").on("submit", function() {
        var e = this;

        $(this).find("[type='submit']").html("Register...");
        $("#dv_register_error").html('');
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: "POST",
            dataType: 'json',
            error: function(XMLHttpRequest, status, error_msg){
                if(XMLHttpRequest.status==404)
                {
                  document.getElementById("dv_register_error").innerHTML='Opps! something went wrong, please try again.';
                  $('#dv_register_error').show();
                  return false;
                  
                }
                else if(XMLHttpRequest.status==500)
                {
                  document.getElementById("dv_register_error").innerHTML='Opps! something went wrong, please try again.';
                  $('#dv_register_error').show();
                  return false;
                }
                else
                {
                  return false;
                }
            
            },
            success: function (data) {

              $(e).find("[type='submit']").html("Register");
                
              if (data.status) {
                  if($('#booking_form_register'))
                  {
                    auth_user=data.auth_user;
                    choose_auth();
                  }
                  else
                  window.location = data.redirect;
              }else{

                  $(".alert").remove();
                  $.each(data.errors, function (key, val) {
                      $("#dv_login_error").append("<div class='alert alert-danger'>" + val + "</div>");
                  });
                  $('#dv_register_error').show();
              }
           
            }
        });

        return false;
    });

  });