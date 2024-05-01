function booking_step(step_id)
{
    $('.booking-step').hide();

    var process=$('.process-steps');
    $('.process-steps').removeClass('btn-success');
    $('.process-steps').removeClass('btn-default');

    for(var pi=0;pi<process.length;pi++)
    {
        if(pi+1==step_id)
        $(process[pi]).addClass('btn-success');
        else
        $(process[pi]).addClass('btn-default');
    }

    $('.booking-step-'+step_id).show();
    if(step_id==3)
    {
        $('.booking-step-'+2).show();
        $('#chk_international_airport_pickup_charges').focus();
    }
    if(step_id==2)
    {
        $('.booking-step-4').show();
        load_vehicles();
        $('#number_of_passenger').focus();
    }
    else{
        $('#booking_from_location').focus();
    }
}

function choose_ride_details()
{
    $('.booking-fields').removeClass('error');
    $('#dv_book_now_error').html('');
    var err=false;
    var err_msg="";
    var service_type="";
    

    var service_type="General Transfer";
    // if(document.getElementById('general_transfer_service').checked==true)
    // service_type="General Transfer";
    // else if(document.getElementById('event_booking_service').checked==true)
    // service_type="Special Event";
    // else if(document.getElementById('estimate_service').checked==true)
    // service_type="Request Quote";
    
    var booking_event=0;
    
    if(service_type=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose service type.';
        err=true;
        $('.general_transfer_service').addClass('error')
        $('.event_booking_service').addClass('error')
        $('.estimate_service').addClass('error')
    }
    else if(service_type=="Special Event" && $('#booking_event option:selected').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose event.';
        err=true;
        $('#booking_event').addClass('error')
    }
    else if(service_type=="Request Quote" && $('#booking_event_quote option:selected').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose event.';
        err=true;
        $('#booking_event_quote').addClass('error')
    }
    else if(service_type=="Special Event" && $('#booking_event option:selected').val()!=""){
        booking_event=$('#booking_event option:selected').val();
    }
    else if(service_type=="Request Quote" && $('#booking_event_quote option:selected').val()!=""){
        booking_event=$('#booking_event_quote option:selected').val();
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
        
        if(service_type=="Request Quote")
        {
            document.location.href=booking_event+"?from="+$('#booking_from_location').val()+"&to="+$('#booking_to_location').val();
        }
        else
        //if(true)
        {


            var url = $('input[name="booking-url"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                
                url:url, 
                    data: {
                    "submit_type":"choose_location",
                    "service_type":service_type,
                    "booking_event": booking_event,
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
                    "total_waypoints":$('#total_waypoints').val(),
                    "booking_waypoint_1":$('#booking_waypoint_1').val(),
                    "waypoint_1":$('#waypoint_1').val(),
                    
                    "w_latitude_1":$('#w_latitude_1').val(),
                    "w_longitude_1":$('#w_longitude_1').val(),

                    "booking_waypoint_2":$('#booking_waypoint_2').val(),
                    "waypoint_2":$('#waypoint_2').val(),
                    
                    "w_latitude_2":$('#w_latitude_2').val(),
                    "w_longitude_2":$('#w_longitude_2').val(),
                    "booking_waypoint_3":$('#booking_waypoint_3').val(),
                    "waypoint_3":$('#waypoint_3').val(),
                    
                    "w_latitude_3":$('#w_latitude_3').val(),
                    "w_longitude_3":$('#w_longitude_3').val(),
                },
                type: 'POST',
                error: function(XMLHttpRequest, status, error_msg){
                    if(XMLHttpRequest.status==404)
                    {
                        document.getElementById("dv_book_now_error").innerHTML='Opps! something went wrong, please try again.';
                        $('#dv_book_now_error').show();
                        return false;
                    
                    }
                    else if(XMLHttpRequest.status==500)
                    {
                        document.getElementById("dv_book_now_error").innerHTML='Opps! something went wrong, please try again.';
                        $('#dv_book_now_error').show();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                
                },
                success: function(response)
                {
                    $('input[name="booking-csrf-token"]').val(response.csrf_token);
                    if(response.success==true)
                    {
                        update_summary('location');
                        if($('#booking_transfer_type option:selected').val()=='Hourly Rate')
                        {
                            document.getElementById('chk_extra_hours_charges').checked=true;
                            $('.extra_hours_charges').show();
                            $('#extra_hours_nos').attr('disabled',false);
                            $('#extra_hours_nos').attr('min',2);
                            $('#is_extra_hours_charges').val(1);
                        }
                        booking_step(2);
                    }
                    else
                    {
                        document.getElementById("dv_book_now_error").innerHTML=response.response_message;
                        $('#dv_book_now_error').show();
                    }
                    return false;
                }
                
            });  
        }
    }
    else{
        $('#dv_book_now_error').show();
        $('#dv_book_now_error').html(err_msg);
    }
}
function book_my_ride()
{
    $('.booking-fields').removeClass('error');
    $('#dv_book_now_error').html('');
    clean_unused();
    var err=false;
    var err_msg="";
    var service_type="General Transfer";
    
    // if(document.getElementById('general_transfer_service').checked==true)
    // service_type="General Transfer";
    // else if(document.getElementById('event_booking_service').checked==true)
    // service_type="Special Event";
    // else if(document.getElementById('estimate_service').checked==true)
    // service_type="Request Quote";
    // var booking_event="";
    
    // if(service_type=="Special Event")
    // booking_event=$('#booking_event option:selected').val();
    
    
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
    if(selected_vehicle_row<0)
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose vehicle.';
        err=true;
    }

    var booking_for="";
    if($('#chk_booking_for_me').attr('checked'))
    {
        booking_for="me";
    }
    else if($('#chk_booking_for_other').attr('checked'))
    {
        booking_for="other";
    }
    if(booking_for=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose booking for.';
        err=true;
    }
    if(booking_for=="other" && $('#company_person').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please enter company/person name.';
        err=true;
    }
    if(booking_for=="other" && $('#other_phone_number').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please enter contact number.';
        err=true;
    }
    if(booking_for=="other" && $('#other_email').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please enter email.';
        err=true;
    }
    /*if($('#booking_bill_to_name').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please enter bill to name.';
        err=true;
    }
    if($('#booking_billing_address').val()=="")
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please enter billing address.';
        err=true;
    }*/
    if(err==false)
    {
        
        

        

        var service_type="Request Quote";
        
        $.ajax({
            url:$('#booking_save_url').val(), 
            data: {
                "service_type":service_type,
                "submit_type":"book_now",
                "booking_date":$('#booking_date').val(),
                "booking_time":$('#booking_time').val(),
                "return_date":$('#return_date').val(),
                "return_time":$('#return_time').val(),
                "booking_from_location":$('#booking_from_location').val(),
                "booking_to_location":$('#booking_to_location').val(),
                "origin":$('#origin').val(),
                "destination":$('#destination').val(),
                "booking_transfer_type":$('#booking_transfer_type').val(),
                "booking_extra_hours":$('#booking_extra_hours').val(),
                "distance":$('#distance').val(),
                "duration":$('#duration').val(),
                "s_latitude":$('#origin_latitude').val(),
                "s_longitude":$('#origin_longitude').val(),
                "d_latitude":$('#destination_latitude').val(),
                "d_longitude":$('#destination_longitude').val(),
                
                "total_waypoints":$('#total_waypoints').val(),
                
                "booking_waypoint_1":$('#booking_waypoint_1').val(),
                "waypoint_1":$('#waypoint_1').val(),
                
                "w_latitude_1":$('#w_latitude_1').val(),
                "w_longitude_1":$('#w_longitude_1').val(),

                "booking_waypoint_2":$('#booking_waypoint_2').val(),
                "waypoint_2":$('#waypoint_2').val(),
                
                "w_latitude_2":$('#w_latitude_2').val(),
                "w_longitude_2":$('#w_longitude_2').val(),
                "booking_waypoint_3":$('#booking_waypoint_3').val(),
                "waypoint_3":$('#waypoint_3').val(),
                
                "w_latitude_3":$('#w_latitude_3').val(),
                "w_longitude_3":$('#w_longitude_3').val(),
                
                "vehicle_type":vehicles_data[selected_vehicle_row].vehicle_type_id,
                "is_international_airport_pickup_charges":$('#is_international_airport_pickup_charges').val(),
                "international_airport_pickup_nos":$('#international_airport_pickup_nos').val(),
                "is_domestic_airport_pickup_charges":$('#is_domestic_airport_pickup_charges').val(),
                "domestic_airport_pickup_nos":$('#domestic_airport_pickup_nos').val(),
                "is_child_seat_charges":$('#is_child_seat_charges').val(),
                "child_seat_nos":$('#child_seat_nos').val(),
                "is_extra_hours_charges":$('#is_extra_hours_charges').val(),
                "extra_hours_nos":$('#extra_hours_nos').val(),
                

                "booking_for":booking_for,
                "company_person":$('#company_person').val(),
                "other_phone_number":$('#other_phone_number').val(),
                "other_email":$('#other_email').val(),
                "bill_to_name":$('#booking_bill_to_name').val(),
                "abn_number":$('#booking_abn_number').val(),
                "billing_address":$('#booking_billing_address').val(),
                "i_flight[number]":$("input[name^='i_flight[number][']").serialize(),
                "i_flight[title]":$("input[name^='i_flight[title][']").serialize(),
                "i_flight[board_name]":$("input[name^='i_flight[board_name][']").serialize(),
                "i_flight[time]":$("input[name^='i_flight[time][']").serialize(),
                "d_flight[number]":$("input[name^='d_flight[number][']").serialize(),
                "d_flight[title]":$("input[name^='d_flight[title][']").serialize(),
                "d_flight[board_name]":$("input[name^='d_flight[board_name][']").serialize(),
                "d_flight[time]":$("input[name^='d_flight[time][']").serialize(),
            },
            type: 'POST',
            error: function(XMLHttpRequest, status, error_msg){
                if(XMLHttpRequest.status==404)
                {
                    document.getElementById("dv_book_now_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_book_now_error').show();
                    return false;
                    
                }
                else if(XMLHttpRequest.status==500)
                {
                    document.getElementById("dv_book_now_error").innerHTML='Opps! something went wrong, please try again.';
                    $('#dv_book_now_error').show();
                    return false;
                }
                else
                {
                    return false;
                }
            
            },
            success: function(response)
            {
                $('input[name="booking-csrf-token"]').val(response.csrf_token);
                if(response.success==true)
                    {
                        window.location.href=response.redirect_url
                    }
                    else
                    {
                        document.getElementById("dv_book_now_error").innerHTML=response.response_message;
                        $('#dv_book_now_error').show();
                    }
                    return false;
            }
            
        }); 

        alert("success");
    }
    else{
        $('#dv_book_now_error').show();
        $('#dv_book_now_error').html(err_msg);
    }
}
/*
    "booking_date":$('#booking_date').val(),
    "booking_time":$('#booking_time').val(),
    "booking_transfer_type":$('#booking_transfer_type').val(),
    "booking_extra_hours":$('#booking_extra_hours').val(),
*/

function update_summary(type)
{
    
    /*if(type=='location')
    {*/
        $('#summary_from').html($('#booking_from_location').val());
        $('#dv_waypoints').hide();
        $('#summary_waypoints').html('');
        var tw=parseInt($('#total_waypoints').val());
        if(isNaN(tw))
        tw=0;

        if(tw>0)
        {
            for(var wi=1;wi<=tw;wi++)
            {
                $('#summary_waypoints').append('<br /> '+wi+'. '+$('#booking_waypoint_'+wi).val());
            }
            $('#dv_waypoints').show();
        }
        
        $('#summary_to').html($('#booking_to_location').val());
        if($('#booking_transfer_type option:selected').text()=='Hourly Rate')
        $('#summary_booking_type').html('Hourly Rate');
        else
        $('#summary_booking_type').html('Distance Wise Rate');

        $('#summary_transfer_type').html($('#booking_transfer_type option:selected').text());

        if ($('#booking_transfer_type option:selected').val() == 'Round Trip') {
            $('#summary_return').show();
            $('#display_div').show();
            $('#summary_return_date_time').html($('#return_date').val()+' '+$('#return_time').val());
        } else {
            $('#summary_return').hide();
            $('#display_div').hide();
            $('#summary_return_date_time').html('');
        }

    /*}*/

    $('#summary_extra_time').html('0 h');
    var total_time=Math.floor($('#duration').val()/60);
    if($('#is_extra_hours_charges').val()==1)//extra_hours_charges
    {
        $('#summary_extra_time').html($('#extra_hours_nos').val()+' h');
        total_time+=($('#extra_hours_nos').val()*60);
    }
    /*chk_international_airport_pickup_charges
    chk_domestic_airport_pickup_charges
    chk_child_seat_charges*/

    
    var total_time_h=Math.floor(total_time/60);
    var total_time_m=total_time - total_time_h*60;

    
    
    $('#summary_total_time').html(total_time_h+' h'+' '+total_time_m+' m');
    $('#summary_distance').html($('#distance').val()+' km');
    
    $('#summary_pickup_date_time').html($('#booking_date').val()+' '+$('#booking_time').val());
    
    $('#summary_vehicle').html('');
    
    if(selected_vehicle_row>=0)
    $('#summary_vehicle').html(vehicles_data[selected_vehicle_row].vehicle_type_description);
    
    $('#summary_pickup_date_time').html();

                    
                    
                    
                    
                    
                    
                    
}

function select_service_type(service_type)
{
    $('#dv_event').hide();
    $('#dv_event_quote').hide();
    $('#booking_event_quote').attr('disabled',true);
    $('#booking_event').attr('disabled',true);
    if(service_type=='Special Event')
    {
        $('#dv_event').show();
        $('#booking_event').attr('disabled',false);
    }
    if(service_type=='Request Quote')
    {
        $('#dv_event_quote').show();
        $('#booking_event_quote').attr('disabled',false);
    }
    
}