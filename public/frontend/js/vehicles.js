var selected_vehicle_row=-1;
var vehicles_data=[];
function load_vehicles(selected_vehicle_no=-1,type_changed=0)
{
  if(type_changed==1)
  {
    if($('#booking_transfer_type option:selected').val()=='Hourly Rate')
    {
      document.getElementById('chk_extra_hours_charges').checked=true;
      $('.extra_hours_charges').show();
      $('#extra_hours_nos').attr('disabled',false);
      $('#is_extra_hours_charges').val(1);
      $('#extra_hours_nos').attr('min',2);
    }
    else{
      document.getElementById('chk_extra_hours_charges').checked=false;
      $('.extra_hours_charges').hide();
      $('#extra_hours_nos').attr('disabled',false);
      $('#is_extra_hours_charges').val(0);
      $('#extra_hours_nos').attr('min',1);
    }
    
  }
  if($('#booking_transfer_type option:selected').val()=='Hourly Rate')
  {
    $('#dv_duration_distance').html('Min 2 Hours Charges');
    $('#dv_duration_distance').hide();
    $('.distance-cost').hide();
    $('#summary_hourly_service').hide();
  }
  else{
    $('#dv_duration_distance').html('Duration & Distance Charges');
    $('#dv_duration_distance').show();
    $('.distance-cost').show();
    $('#summary_hourly_service').hide();
  }


    $('#dv_load_vehicle_error').html('');


    $.ajax({
        url:$('input[name="booking-get-vehicles-url"]').val(), 
        data: {
            "number_of_passenger": $('#number_of_passenger option:selected').val(),
            "number_of_suitcase": $('#number_of_suitcase option:selected').val(),
            "vehicle_type": $('#vehicle_type option:selected').val(),
            "booking_transfer_type": $('#booking_transfer_type option:selected').val(),
            
      },
      cache: false,
        type: 'POST',
        error: function(XMLHttpRequest, status, error_msg){
            if(XMLHttpRequest.status==404)
            {
              document.getElementById("dv_load_vehicle_error").innerHTML='Opps! something went wrong, please try again.';
              $('#dv_load_vehicle_error').show();
              return false;
              
            }
            else if(XMLHttpRequest.status==500)
            {
              document.getElementById("dv_load_vehicle_error").innerHTML='Opps! something went wrong, please try again.';
              $('#dv_load_vehicle_error').show();
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
            html = "";
            $('#v_count').val(0);
            vehicles_data=response.data;
            $.each(response.data, function(index,value) {
                    
                    var total_price =value.travel_cost;
                    
                    var vcount=parseInt($('#v_count').val());
                    if(isNaN(vcount))
                    vcount=0;

                    html +='<div class="col-sm-12 mb-5">';
                    html +='<div class="row">';
                    html +='<div class="col-sm-6">';
                      html +='<a href="#"><img src="/frontend/images/booking/car-01.jpg" class="img-responsive vehicle-image"></a>';
                    html +='</div>';
                    html +='<div class="col-sm-6">';
                      html +='<h3>'+ value.vehicle_type +'</h3>';
                      html +='<div class="name-car">';
                        html +='4 Matic';
                      html +='</div>';
                      html +='<div class="content">';
                        html +='<ul>';
                        html +='<li><img src="/frontend/images/booking/people.png" alt=""> Max . '+ value.no_of_passengers +'</li>';
                        html +='<li><img src="/frontend/images/booking/vali.png" alt=""> Max . '+ value.no_of_suitcases +'</li>';
                        html +='</ul>';
                      html +='</div>';
                      html +='<div class="content">';
                      html +='<h5>$ <span id="vehicle_price_'+vcount+'">'+ total_price +'<span></h5>';
                      html +='</div>';
                      if(vcount==0 && false)
                      html +='<a id="select_vehicle'+vcount+'" href="javascript:choose_vehicle_new('+vcount+');" class="btn btn-booking booking-active vehicle-select-btn-web vehicle-select-btn" style="background-color: #d7d2bd;margin-top: 107px;">Select</a>';
                      else
                      html +='<a id="select_vehicle'+vcount+'" href="javascript:choose_vehicle_new('+vcount+');" class="btn btn-booking booking-inactive vehicle-select-btn-web vehicle-select-btn">Select</a>';
                    html +='</div>';
                    html +='</div>';
                    html +='</div>';
                    
                    vcount++;
                    $('#v_count').val(vcount);
            });
            $('#vehicle_ajax').empty('').append(html);
            //choose_vehicle(0);
            if(selected_vehicle_no>-1)
            {
              choose_vehicle_new(selected_vehicle_no);
            }
        }
        
      }); 
    
}

function choose_vehicle(rw)
{
    selected_vehicle_row=rw;
    $('.btn-booking').removeClass('booking-active');
    $('.btn-booking').removeClass('booking-inactive');
    $('.btn-booking').addClass('booking-inactive');
    $('#select_vehicle'+rw).removeClass('booking-inactive');
    $('#select_vehicle'+rw).addClass('booking-active');

    

    var total_price=parseInt($('#vehicle_price_'+rw).html());
    if(isNaN(total_price))
    total_price=0;
    if($('#booking_transfer_type option:selected').val()=='Hourly Rate')
    {
      total_price=0;
    }
    
    $('#dv_total_cost').html('$'+total_price);
    $('#dv_total_cost_summary').html('$'+total_price);
    var total_booking_price=total_price;
    

    

    $('#international_airport_pickup_charges').val(vehicles_data[rw].international_airport_pickup_charges);
    $('#domestic_airport_pickup_charges').val(vehicles_data[rw].domestic_airport_pickup_charges);
    $('#child_seat_charges').val(vehicles_data[rw].child_seat_charges);
    $('#extra_hours_charges').val(vehicles_data[rw].extra_waiting_time*60);
    

    $('#i_airport_pickup_charges').html('$'+vehicles_data[rw].international_airport_pickup_charges);
    $('#d_airport_pickup_charges').html('$'+vehicles_data[rw].domestic_airport_pickup_charges);
    $('#c_seat_charges').html('$'+vehicles_data[rw].child_seat_charges);
    $('#c_extra_hours_charges').html('$'+(vehicles_data[rw].extra_waiting_time*60));
    


    $('#summary_internation').html('');
    $('#summary_domestic').html('');
    $('#summary_child').html('');
    $('#summary_internation').hide();
    $('#summary_domestic').hide();
    $('#summary_child').hide();
    
    
      
    

    var total_extra_price=0;
    if($('#is_international_airport_pickup_charges').val()==1)
    {
      var iapc=parseInt($('#international_airport_pickup_nos').val());
      if(isNaN(iapc))
      iapc=1;
      
      $('#summary_internation').html(iapc+" x International Airport Pickup = $"+iapc*vehicles_data[rw].international_airport_pickup_charges);
      $('#summary_internation').show();
    
      total_extra_price=total_extra_price+(iapc*vehicles_data[rw].international_airport_pickup_charges);
    }
    if($('#is_domestic_airport_pickup_charges').val()==1)
    {
      var dapc=parseInt($('#domestic_airport_pickup_nos').val());
      if(isNaN(dapc))
      dapc=1;
      $('#summary_domestic').html(dapc+" x Domestic Airport Pickup = $"+dapc*vehicles_data[rw].domestic_airport_pickup_charges);
      $('#summary_domestic').show();
    
      total_extra_price=total_extra_price+(dapc*vehicles_data[rw].domestic_airport_pickup_charges);
    }
    if($('#is_child_seat_charges').val()==1)
    {
      var csc=parseInt($('#child_seat_nos').val());
      if(isNaN(csc))
      csc=1;
      $('#summary_child').html(csc+" x Child Seat = $"+csc*vehicles_data[rw].child_seat_charges);
      $('#summary_child').show();
    

      total_extra_price=total_extra_price+(csc*vehicles_data[rw].child_seat_charges);
    }
    $('#dv_total_extra_hours').hide();
    $('#summary_extra').hide();

    $('#dv_distance_duration').html($('#dvDistance').html()+'/'+$('#dvDuration').html());
    
    if($('#booking_transfer_type option:selected').val()=='Hourly Rate')
    {
      $('#extra_hours_nos').attr('min',vehicles_data[rw].minimum_hour);
    }
    else{
      $('#extra_hours_nos').attr('min',1);
    }

    if($('#is_extra_hours_charges').val()==1)
    {
      var ewh=parseInt($('#extra_hours_nos').val());
      if(isNaN(ewh))
      ewh=vehicles_data[rw].minimum_hour;

      if(ewh<vehicles_data[rw].minimum_hour)
      ewh=vehicles_data[rw].minimum_hour;

      $('#extra_hours_nos').val(ewh)
      


      
      
      total_booking_price=total_booking_price+(ewh*vehicles_data[rw].extra_waiting_time*60);
    
      $('#span_total_extra_hours_cost').html(ewh+'hour X $'+(vehicles_data[rw].extra_waiting_time*60));
      $('#dv_total_extra_hours_cost').html('$'+(ewh*vehicles_data[rw].extra_waiting_time*60));
      $('#dv_total_extra_hours').show();
    }

    $('#dv_total_extra_cost').html('$'+total_extra_price);
    $('#dv_total_extra_cost_summary').html('$'+total_extra_price+(ewh*vehicles_data[rw].extra_waiting_time*60));
  
    if(total_extra_price>0)
    {

      $('#dv_total_extra').show();
      $('#summary_extra').show();
      $('#dv_total_extra_summary').show();
      $('#summary_extra_summary').show();
    }
    else
    {
      $('#dv_total_extra').hide();
      $('#summary_extra').hide();
      $('#dv_total_extra_summary').hide();
      $('#summary_extra_summary').hide();
    }
    total_booking_price=total_booking_price+total_extra_price;
    
    $('#dv_total_booking_cost').html('$'+total_booking_price);
    $('#dv_total_booking_cost_summary').html('$'+total_booking_price);


    if($('#is_international_airport_pickup_charges').val()==1)
    {
      var iapc=parseInt($('#international_airport_pickup_nos').val());
      if(isNaN(iapc))
      iapc=1;
      var ifn=$('.i_flights');
      var ifnl=0;
      if(ifn)
      ifnl=ifn.length;

      if(iapc<ifnl)
      {
        for(var i=ifnl;i>iapc;i--)
        {
            $('#i_flights_'+i).remove();
        }
      }
      else if(ifnl<iapc){

        for(var i=ifnl+1;i<=iapc;i++)
        {
            var html='';
            html+='<div class="row mt20 i_flights" id="i_flights_'+i+'">';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Flight No. '+i+'</label>';
            html+='<input type="text" name="i_flight[number][]" id="i_flight_no_'+i+'" class="form-control" value="" />';
            html+='</div>';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Title '+i+'</label>';
            html+='<select type="text" class="form-control" name="i_flight[title][]" id="i_title_'+i+'" value="" >';
            html+='<option value="Mr" selected>Mr.</option>';
            html+='<option value="Mrs">Mrs.</option>';
            html+='<option value="Ms">Ms.</option>';
            html+='<option value="Dr">Dr.</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Name on Board '+i+'</label>';
            html+='<input type="text" class="form-control" name="i_flight[board_name][]" id="i_name_'+i+'" value="" />';
            html+='</div>';
            //html+='<div class="col-md-3">';
            //html+='<label class="" style="text:black;">Pickup Time '+i+'</label>';
            //html+='<input type="text" class="form-control" name="i_flight[time][]" id="i_time_'+i+'" value="" >';
            //html+='</div>';
            html+='</div>';
            $('#international_airport_pickup_charges_content').append(html);
        }
      }
      
    }
    if($('#is_domestic_airport_pickup_charges').val()==1)
    {
      var dapc=parseInt($('#domestic_airport_pickup_nos').val());
      if(isNaN(dapc))
      dapc=1;

      var dfn=$('.d_flights');
      var dfnl=0;
      if(dfn)
      dfnl=dfn.length;

      if(dapc<dfnl)
      {
        for(var i=dfnl;i>dapc;i--)
        {
            $('#d_flights_'+i).remove();
        }
      }
      else if(dfnl<dapc){

        for(var i=dfnl+1;i<=dapc;i++)
        {
            var html='';
            html+='<div class="row mt20 d_flights" id="d_flights_'+i+'">';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Flight No. '+i+'</label>';
            html+='<input type="text" name="d_flight[number][]" id="d_flight_no_'+i+'" class="form-control" value="" >';
            html+='</div>';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Title '+i+'</label>';
            html+='<select type="text" class="form-control" name="d_flight[title][]" id="i_name_'+i+'" value="" >';
            html+='<option value="Mr">Mr.</option>';
            html+='<option value="Mrs">Mrs.</option>';
            html+='<option value="Ms">Ms.</option>';
            html+='<option value="Dr">Dr.</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="col-md-3">';
            html+='<label class="" style="text:black;">Name on Board '+i+'</label>';
            html+='<input type="text" class="form-control" name="d_flight[board_name][]" id="i_name_'+i+'" value="" >';
            html+='</div>';
            //html+='<div class="col-md-3">';
            //html+='<label class="" style="text:black;">Pickup Time '+i+'</label>';
            //html+='<input type="text" class="form-control" name="d_flight[time][]" id="i_time_'+i+'" value="" >';
            //html+='</div>';
            html+='</div>';
            $('#domestic_airport_pickup_charges_content').append(html);
        } 
      }
    }
    update_summary('vehicle');
    choose_auth();

}
function choose_auth()
{
  $('.booking_for_details').hide();
  $('#dv_book_now').hide();  
  
  if(auth_user)
  {
    $('#login_register_tab').hide();
    $('#booking_form_user_name').val(auth_user.name);
    $('#booking_form_user_phone').val(auth_user.phone);
    $('#booking_form_user_email').val(auth_user.email);
    $('input[name="booking-csrf-token"]').val(auth_user.csrf_token);

    $('#dv_booking_for_details').show();  
    $('#dv_book_now').show();  
    
  }
  else{
    $('#user_login_form').show();
    $('#handleAjax').show();
  }

}
function choose_other_vehicle()
{
  selected_vehicle_row=-1;
  $('#selected_vehicle_ajax').html('');
  //document.getElementById('number_of_passenger').value="1";
  //document.getElementById('number_of_suitcase').value="1";
  //document.getElementById('vehicle_type').value="0";
  booking_step(2);
}
function choose_vehicle_new(rw)
{
  $('.extra_option_select').hide();
  $('#chk_international_airport_pickup_charges').attr('checked',false);
  $('#chk_domestic_airport_pickup_charges').attr('checked',false);
  $('#chk_child_seat_charges').attr('checked',false);

  $('#international_airport_pickup_nos').val(1);
  $('#domestic_airport_pickup_nos').val(1);
  $('#child_seat_nos').val(1);
  
    selected_vehicle_row=rw;
    
    var total_price =vehicles_data[rw].travel_cost;
    var html="";
    // html +='<div class="booking__fleet" data-aos="fade-up">';
    // html +='<div class="left">';
    html +='<div class="col-sm-6">';
      html +='<a href="#"><img src="/frontend/images/booking/car-01.jpg" class="img-responsive"></a>';
    html +='</div>';
    html +='<div class="col-sm-6">';
      html +='<h3>'+ vehicles_data[rw].vehicle_type +'</h3>';
      html +='<h3>'+ vehicles_data[rw].vehicle_type_description +'</h3>';
      html +='<div class="name-car">';
        html +='4 Matic';
      html +='</div>';
      html +='<div class="content">';
        html +='<ul>';
        html +='<li><img src="/frontend/images/booking/people.png" alt=""> Max . '+ vehicles_data[rw].no_of_passengers +'</li>';
        html +='<li><img src="/frontend/images/booking/vali.png" alt=""> Max . '+ vehicles_data[rw].no_of_suitcases +'</li>';
        html +='</ul>';
      html +='</div>';
      html +='<div class="content">';
      html +='<h5>$ <span id="vehicle_price_'+rw+'">'+ total_price +'<span></h5>';
      html +='</div>';
      if(rw==0 && false)
      html +='<a id="select_vehicle'+rw+'" href="javascript:choose_other_vehicle();" class="btn btn-warning btn-raised" style="margin-top:25px;"><i class="fa fa-check"></i> Select</a>';
      else
      html +='<a id="select_vehicle'+rw+'" href="javascript:choose_other_vehicle();" class="btn btn-warning btn-raised" style="margin-top:25px;"><i class="fa fa-check"></i>  Choose Other Vehicle</a>';
    html +='</div>';
    $('#selected_vehicle_ajax').empty('').append(html);
    booking_step(3);
    choose_vehicle(rw)
    
}


function extra_charges(id,obj)
{
  if('is_'+id== 'is_extra_hours_charges' && $('#booking_transfer_type option:selected').val()=='Hourly Rate')
  {
    obj.checked=true;
  }
if(obj.checked)
{
  $('.'+id).show();
  $('#extra_hours_nos').attr('disabled',false);
  $('#international_airport_pickup_nos').attr('disabled',false);
  $('#domestic_airport_pickup_nos').attr('disabled',false);
  $('#child_seat_nos').attr('disabled',false);
  
  $('#is_'+id).val(1);
}
else{
  $('.'+id).hide();
  $('#is_'+id).val(0);
}
  
  choose_vehicle(selected_vehicle_row);
  
}

function num_up_down(dir,id)
{
  var obj=$('#'+id);
  var max=parseInt($(obj).attr('max'));
  if(isNaN(max))
  {
    max=5;
    if(id=='child_seat_nos')
    {
      max=2;
    }
  }
  var min=parseInt($(obj).attr('min'));
  if(isNaN(min))
  min=1;
  
  var curr_val=parseInt($(obj).val());
  if(isNaN(curr_val))
  curr_val=1;

  if(dir=='up' && curr_val<max)
  {
    curr_val=curr_val+1;
    
  }
  else if(dir=='down' && curr_val>min){
    curr_val=curr_val-1;
  }
  else if(dir=='change'){
    if(curr_val<min)
    curr_val=min;
    else if(curr_val>max)
    curr_val=max;
  }
  $(obj).val(curr_val);

  choose_vehicle(selected_vehicle_row);
}

function book_vehicle(type, url)
{
    var err=false;
    var err_msg="";
    if(selected_vehicle_row<0)
    {
        if(err==true)
        {
            err_msg+="<br />";
        }
        err_msg+='Please choose vehicle.';
        err=true;
        $('#number_of_passenger').addClass('error')
    }
    if(err==false)
    {

        

            var url = $('input[name="booking-url"]').val();
            
            $.ajax({
              url:url, 
              data: {
                "submit_type":"choose_vehicle",
                "vehicle_type":vehicles_data[selected_vehicle_row].vehicle_type_id,
                "is_international_airport_pickup_charges":$('#is_international_airport_pickup_charges').val(),
                "international_airport_pickup_nos":$('#international_airport_pickup_nos').val(),
                "is_domestic_airport_pickup_charges":$('#is_domestic_airport_pickup_charges').val(),
                "domestic_airport_pickup_nos":$('#domestic_airport_pickup_nos').val(),
                "is_child_seat_charges":$('#is_child_seat_charges').val(),
                "child_seat_nos":$('#child_seat_nos').val(),
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
                $('input[name="booking-csrf-token"]').val(response.csrf_token);
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