$(function() {
        
    /*------------------------------------------
    --------------------------------------------
    Submit Event
    --------------------------------------------
    --------------------------------------------*/
    $("#login_submit").on("click", function() {
        
        var form = $("#user_login_form");
        var url=$(form).attr('action');
        var data=$(form).serialize();
        $("#dv_login_error").html('');
        $(form).find("[type='submit']").html("Please wait...");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $.ajax({
                url: url,
                data: data,
                type: "POST",
                dataType: 'json',
                error: function(XMLHttpRequest, status, error_msg){
                    if(XMLHttpRequest.status==404)
                    {
                    document.getElementById("dv_login_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_login_error').show();
                    return false;
                    
                    }
                    else if(XMLHttpRequest.status==500)
                    {
                    document.getElementById("dv_login_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_login_error').show();
                    return false;
                    }
                    else
                    {
                    return false;
                    }
                
                },
                success: function (data) {

                    $(form).find("[type='submit']").html("Login");

                    if (data.status) {
                        if($('#booking_form_login'))
                        {
                            auth_user=data.auth_user;
                            
                            load_vehicles(selected_vehicle_row);
                            //choose_auth();
                        }
                        else
                        window.location = data.redirect;
                    }else{
                        $(".alert").remove();
                        $.each(data.errors, function (key, val) {
                            $("#dv_login_error").append("<div class='alert alert-danger'>" + val + "</div>");
                        });
                    }
            
                }
            });

           
        });
        
        
  });