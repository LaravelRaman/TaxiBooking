function booknow(type, url)
{
    $('.booking-fields').removeClass('error');
    
    var err=false;
    var err_msg="";
    var service_type="";
    if(type=='quote')
    {
        service_type="Request Quote";
    }
    else{
        if(document.getElementById('general_transfer_service').checked==true)
        service_type="General Transfer";
        else if(document.getElementById('event_booking_service').checked==true)
        service_type="Special Event";
        else if(document.getElementById('estimate_service').checked==true)
        service_type="Request Quote";
        var booking_event="";
        
        if(service_type=="Special Event")
        booking_event=$('#booking_event option:selected').val();
       
    }
    
    if(service_type=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose service type.';
        err=true;
        $('#general_transfer_service').addClass('error')
    }
    if($('#booking_date').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Please select pickup date.";
        err=true;
        $('#booking_date').addClass('error')
    }
    if($('#booking_time').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Please select pickup time.";
        err=true;
        $('#booking_time').addClass('error')
    }
    if($('#booking_from_location').val()=="" || $('#origin').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Please select pickup location.";
        err=true;
        $('#booking_from_location').addClass('error')
    }
    if($('#booking_to_location').val()=="" || $('#destination').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Please select drop location.";
        err=true;
        $('#booking_to_location').addClass('error')
    }
    if($('#booking_transfer_type').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Please select transfer type.";
        err=true;
        $('#booking_transfer_type').addClass('error')
    }
    if(isNaN(parseFloat($('#distance').val())) || parseFloat($('#distance').val())<=0)
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Travel distance should be greater than zero.";
        err=true;
        $('#booking_from_location').addClass('error')
        $('#booking_to_location').addClass('error')
    }
    else if(isNaN(parseFloat($('#duration').val())) || parseFloat($('#duration').val())<=0)
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+="Travel duration should be greater than zero.";
        err=true;
        $('#booking_from_location').addClass('error')
        $('#booking_to_location').addClass('error')
    }

    if(err==false)
    {
        
        

            var url = $('input[name="booking-url"]').val();
            
            $.ajax({
              url:url, 
              data: {
                "submit_type":"choose_location",
                "service_type":service_type,
                "booking_event": booking_event,
                //"booking_date":$('#booking_date').val(),
                //"booking_time":$('#booking_time').val(),
                "booking_from_location":$('#booking_from_location').val(),
                "booking_to_location":$('#booking_to_location').val(),
                "origin":$('#origin').val(),
                "destination":$('#destination').val(),
                //"booking_transfer_type":$('#booking_transfer_type').val(),
                //"booking_extra_hours":$('#booking_extra_hours').val(),
                "distance":$('#distance').val(),
                "duration":$('#duration').val(),
                "s_latitude":$('#origin_latitude').val(),
                "s_longitude":$('#origin_longitude').val(),
                "d_latitude":$('#destination_latitude').val(),
                "d_longitude":$('#destination_longitude').val(),
            },
              type: 'POST',
              error: function(XMLHttpRequest, status, error_msg){
                
                  if(XMLHttpRequest.status==404)
                  {
                    document.getElementById("dv_booking_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_booking_error').show();
                    return false;
                    
                  }
                  else if(XMLHttpRequest.status==500)
                  {
                    document.getElementById("dv_booking_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_booking_error').show();
                    return false;
                  }
                  else
                  {
                    return false;
                  }
              
              },
              success: function(response)
              {
                  if(response.success==true)
                    {
                        document.location.href=$('input[name="booking-next-url"]').val();
                    }
                    else
                    {
                      document.getElementById("dv_booking_error").innerHTML=response.response_message;
                        $('#dv_booking_error').show();
                    }
                    return false;
              }
              
            });  
            
    }
    else{
        $('#dv_booking_error').show();
        $('#dv_booking_error').html(err_msg);
    }
    
}
function GetAQuote(url)
    {
        $('#dvQuoteData').hide();
        $('.booking-fields').removeClass('error');
        
        var err=false;
        var err_msg="";
        
        if($('#booking_from_location').val()=="" || $('#origin').val()=="")
        {
            if(err==true)
            {
                err_msg+="<br />";
            }
            err_msg+="Please select pickup location.";
            err=true;
            $('#booking_from_location').addClass('error')
        }
        if($('#booking_to_location').val()=="" || $('#destination').val()=="")
        {
            if(err==true)
            {
                err_msg+="<br />";
            }
            err_msg+="Please select drop location.";
            err=true;
            $('#booking_to_location').addClass('error')
        }
        if(isNaN(parseFloat($('#distance').val())) || parseFloat($('#distance').val())<=0)
        {
            if(err==true)
            {
                err_msg+="<br />";
            }
            err_msg+="Travel distance should be greater than zero.";
            err=true;
            $('#booking_from_location').addClass('error')
            $('#booking_to_location').addClass('error')
        }
        else if(isNaN(parseFloat($('#duration').val())) || parseFloat($('#duration').val())<=0)
        {
            if(err==true)
            {
                err_msg+="<br />";
            }
            err_msg+="Travel duration should be greater than zero.";
            err=true;
            $('#booking_from_location').addClass('error')
            $('#booking_to_location').addClass('error')
        }

        if(err==false)
        {            

            var service_type="Request Quote";
                
                
                $.ajax({
                url:url, 
                data: {
                    "service_type":service_type,
                    "booking_event": 0,
                    "submit_type":"choose_location",
                    "booking_from_location":$('#booking_from_location').val(),
                    "booking_to_location":$('#booking_to_location').val(),
                    "origin":$('#origin').val(),
                    "destination":$('#destination').val(),
                    "distance":$('#distance').val(),
                    "duration":$('#duration').val(),
                    "s_latitude":$('#origin_latitude').val(),
                    "s_longitude":$('#origin_longitude').val(),
                    "d_latitude":$('#destination_latitude').val(),
                    "d_longitude":$('#destination_longitude').val(),
                },
                type: 'POST',
                error: function(XMLHttpRequest, status, error_msg){
                    if(XMLHttpRequest.status==404)
                    {
                        document.getElementById("dv_booking_error").innerHTML='Opps! something went wrong, please try again.';
                        $('#dv_booking_error').show();
                        return false;
                        
                    }
                    else if(XMLHttpRequest.status==500)
                    {
                        document.getElementById("dv_booking_error").innerHTML='Opps! something went wrong, please try again.';
                        $('#dv_booking_error').show();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                
                },
                success: function(response)
                {
                    if(response.data.success==true)
                        {
                            if(response.data.travel_cost>0)
                            {
                                $('#dvQuote').val(response.data.travel_cost+' AUD');
                                $('#dvQuoteData').show();
                            }
                            else{
                                document.getElementById("dv_booking_error").innerHTML=response.data.response_message;
                                 $('#dv_booking_error').show();
                            }
                        }
                        else
                        {
                            document.getElementById("dv_booking_error").innerHTML=response.data.response_message;
                            $('#dv_booking_error').show();
                        }
                        return false;
                }
                
                });  
                
        }
        else{
            $('#dv_booking_error').show();
            $('#dv_booking_error').html(err_msg);
        }
        
    }
