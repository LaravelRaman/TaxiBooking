
        var directionsDisplay;
        var directionsService;
        var map;
        function initMap()
        {
            directionsService = new google.maps.DirectionsService();
            initialize();
            $("#a_remove_waypoint_1").hide();
            $("#a_remove_waypoint_2").hide();
            $("#a_remove_waypoint_3").hide();
            $("#dv_way_point_1").hide();
            $("#dv_way_point_2").hide();
            $("#dv_way_point_3").hide();

            var way_points=parseInt($('#total_waypoints').val());
            if(isNaN(way_points))
            way_points=0;
            $("#a_remove_waypoint_"+way_points).show();
            for(var w=1;w<=way_points;w++)
            $("#dv_way_point_"+w).show();
            
        }
        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var sydney = new google.maps.LatLng(current_latitude,current_longitude);
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: sydney,
                mapTypeControl: false,
                zoomControl: true,
                zoom: 12,
                styles : [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#e4e8e9"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#7de843"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#9bd0e8"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]
            }
            map = new google.maps.Map(document.getElementById("g_map"), mapOptions);
            directionsDisplay.setMap(map);
            new AutocompleteDirectionsHandler(map);
            calcRoute();
        }

        function calcRoute() {
            //var start = document.getElementById("start").value;
            //var end = document.getElementById("end").value;

            $('#dvDistance').html(0+' km');
            $('#dvDuration').html('0 h 0 m');
            $('#distance').val(0);
            $('#duration').val(0);

            var waypts = [];
            

            var way_points=parseInt($('#total_waypoints').val());
            if(isNaN(way_points))
            way_points=0;
            
            for(w=1;w<=way_points;w++)
            {
                /*if(w==1)
                waypts.push({location:me.waypointPlaceId1,stopover:false}); 
                if(w==2)
                waypts.push({location:me.waypointPlaceId2,stopover:false}); 
                if(w==3)
                waypts.push({location:me.waypointPlaceId3,stopover:false}); */
                if($('#waypoint_1').val()!='')
                waypts.push({location:new google.maps.LatLng($('#w_latitude_'+w).val(),$('#w_longitude_'+w).val()),stopover:true}); 
            }
/*            var checkboxArray = document.getElementById('waypoints');
            for(var i = 0; i < checkboxArray.length; i++) {
                if(checkboxArray.options[i].selected == true) {
                    waypts.push({
                        location: checkboxArray[i].value,
                        stopover: true
                    });
                }
            }
*/

            var request = {
                origin: new google.maps.LatLng($('#origin_latitude').val(),$('#origin_longitude').val()),
                destination: new google.maps.LatLng($('#destination_latitude').val(),$('#destination_longitude').val()),
                waypoints: waypts,
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.metric, //IMPEARIAL for miles/feet
            };
            directionsService.route(request, function(response, status) {
                if(status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];


                    

                    var duration=0;
                    var distance=0;
                    for(var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        
                        route.legs[i].duration.text;
                        route.legs[i].distance.text;

                        duration+=route.legs[i].duration.value;
                        distance+=route.legs[i].distance.value;

                    }
                    
                    var distance_in_kilo = parseFloat((distance/1000).toFixed(1));
                    var distance_in_miles = distance/1609.34;

                    var duration_h = Math.floor((duration/60)/60);
                    var duration_m = Math.round((duration/60)-(duration_h*60),0);

                    
                    $('#dvDistance').html(distance_in_kilo+' km');
                    $('#dvDuration').html(duration_h+' h '+duration_m+' m');
                    $('#distance').val(distance_in_kilo);
                    $('#duration').val(duration);




                    //  alert(route.legs[1].duration.text);
                   /* var summaryPanel = document.getElementById('directions_panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    for(var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].duration.text + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                    }*/

                }
            });
        }

        //google.maps.event.addDomListener(window, 'load', initialize);

        function AutocompleteDirectionsHandler(map) {
            
            this.travelMode = 'DRIVING';
            
            var originInput = document.getElementById('booking_from_location');
            var destinationInput = document.getElementById('booking_to_location');
            var originLatitude = document.getElementById('origin_latitude');
            var originLongitude = document.getElementById('origin_longitude');
            var destinationLatitude = document.getElementById('destination_latitude');
            var destinationLongitude = document.getElementById('destination_longitude');
        
        
            var waypointInput1 = document.getElementById('booking_waypoint_1');
            var waypointInput2 = document.getElementById('booking_waypoint_2');
            var waypointInput3 = document.getElementById('booking_waypoint_3');
            var waypointLatitude1 = document.getElementById('w_latitude_1');
            var waypointLongitude1 = document.getElementById('w_longitude_1');
            var waypointLatitude2 = document.getElementById('w_latitude_2');
            var waypointLongitude2 = document.getElementById('w_longitude_2');
            var waypointLatitude3 = document.getElementById('w_latitude_3');
            var waypointLongitude3 = document.getElementById('w_longitude_3');
            
        
            var polylineOptionsActual = new google.maps.Polyline({
                    strokeColor: '#111',
                    strokeOpacity: 0.8,
                    strokeWeight: 4
            });
            var center = { lat: 50.064192, lng: -130.605469 };
            // Create a bounding box with sides ~10km away from the center point
            var defaultBounds = {
                north: center.lat + 0.1,
                south: center.lat - 0.1,
                east: center.lng + 0.1,
                west: center.lng - 0.1,
            };
            var options = {
                bounds: defaultBounds,
                componentRestrictions: { country: "au" },
                //fields: ["address_components", "geometry", "icon", "name"],
                strictBounds: false,
                //types: ["establishment"],
            };

            var originAutocomplete = new google.maps.places.Autocomplete(
                    originInput,options);
            var destinationAutocomplete = new google.maps.places.Autocomplete(
                    destinationInput,options);
          
            originAutocomplete.addListener('place_changed', function(event) {
                var place = originAutocomplete.getPlace();
                
                if (place.hasOwnProperty('place_id')) {
                    if (!place.geometry) {
                            // window.alert("Autocomplete's returned place contains no geometry");
                            return;
                    }
                    originLatitude.value = place.geometry.location.lat();
                    originLongitude.value = place.geometry.location.lng();
                    $('#origin').val(place.formatted_address);
                    calcRoute();
                   
                } else {
                    service.textSearch({
                            query: place.name
                    }, function(results, status) {
                        
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            originLatitude.value = results[0].geometry.location.lat();
                            originLongitude.value = results[0].geometry.location.lng();
                            $('#origin').val(results[0].formatted_address);
                    calcRoute();
                        }
                    });
                }
            });
        
        
            destinationAutocomplete.addListener('place_changed', function(event) {
                var place = destinationAutocomplete.getPlace();
               
                if (place.hasOwnProperty('place_id')) {
                    if (!place.geometry) {
                        // window.alert("Autocomplete's returned place contains no geometry");
                        return;
                    }
                    destinationLatitude.value = place.geometry.location.lat();
                    destinationLongitude.value = place.geometry.location.lng();
                    $('#destination').val(place.formatted_address);
                    calcRoute();
                } else {
                    service.textSearch({
                        query: place.name
                    }, function(results, status) {
        
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            destinationLatitude.value = results[0].geometry.location.lat();
                            destinationLongitude.value = results[0].geometry.location.lng();
                            $('#destination').val(results[0].formatted_address);
                    calcRoute();
                        }
                    });
                }
            });
            
            var waypointAutocomplete1 = new google.maps.places.Autocomplete(waypointInput1,options);
                waypointAutocomplete1.addListener('place_changed', function(event) {
                    var place = waypointAutocomplete1.getPlace();
        
                    if (place.hasOwnProperty('place_id')) {
                        if (!place.geometry) {
                                // window.alert("Autocomplete's returned place contains no geometry");
                                return;
                        }
                        waypointLatitude1.value = place.geometry.location.lat();
                        waypointLongitude1.value = place.geometry.location.lng();
                        $('#waypoint_1').val(place.formatted_address);
                    calcRoute();
                    
                    } 
                    else {
                        service.textSearch({
                                query: place.name
                        }, function(results, status) {
                            
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                waypointLatitude1.value = results[0].geometry.location.lat();
                                waypointLongitude1.value = results[0].geometry.location.lng();
                                $('#waypoint_1').val(results[0].formatted_address);
                    calcRoute();
                            }
                        });
                    }
            });
            var waypointAutocomplete2 = new google.maps.places.Autocomplete(
            waypointInput2,options);
            waypointAutocomplete2.addListener('place_changed', function(event) {
                var place = waypointAutocomplete2.getPlace();
    
                if (place.hasOwnProperty('place_id')) {
                    if (!place.geometry) {
                            // window.alert("Autocomplete's returned place contains no geometry");
                            return;
                    }
                    waypointLatitude2.value = place.geometry.location.lat();
                    waypointLongitude2.value = place.geometry.location.lng();
                    $('#waypoint_2').val(place.formatted_address);
                    calcRoute();
                
                } else {
                    service.textSearch({
                            query: place.name
                    }, function(results, status) {
                        
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            waypointLatitude2.value = results[0].geometry.location.lat();
                            waypointLongitude2.value = results[0].geometry.location.lng();
                            $('#waypoint_2').val(results[0].formatted_address);
                    calcRoute();
                        }
                    });
                }
            });
        var waypointAutocomplete3 = new google.maps.places.Autocomplete(
            waypointInput3,options);
            waypointAutocomplete3.addListener('place_changed', function(event) {
                var place = waypointAutocomplete3.getPlace();
    
                if (place.hasOwnProperty('place_id')) {
                    if (!place.geometry) {
                            // window.alert("Autocomplete's returned place contains no geometry");
                            return;
                    }
                    waypointLatitude3.value = place.geometry.location.lat();
                    waypointLongitude3.value = place.geometry.location.lng();
                    $('#waypoint_3').val(place.formatted_address);
                    calcRoute();
                
                } else {
                    service.textSearch({
                            query: place.name
                    }, function(results, status) {
                        
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            waypointLatitude3.value = results[0].geometry.location.lat();
                            waypointLongitude3.value = results[0].geometry.location.lng();
                            $('#waypoint_3').val(results[0].formatted_address);
                    calcRoute();
                        }
                    });
                }
            });
        
        add_waypoint(0);
    
    }

function add_waypoint(wt)
{
    $("#a_remove_waypoint_1").hide();
    $("#a_remove_waypoint_2").hide();
    $("#a_remove_waypoint_3").hide();

    var way_points=parseInt($('#total_waypoints').val());
    if(isNaN(way_points))
    way_points=0;

    for(w=1;w<=way_points;w++)
    {
        $('#dv_way_point_'+w).show();
    }
    if(wt==1)
    if(way_points>=3)
    {
        
        alert('No more waypoints can be added.')
    }   
    else{
        way_points++;
        $('#dv_way_point_'+way_points).show();
        $("#a_remove_waypoint_"+way_points).show();
        $('#booking_waypoint_'+way_points).attr('disabled',false);
        $('#booking_waypoint_'+way_points).focus();
    }
    $('#total_waypoints').val(way_points);
    
    
}
function clear_lat(obj)
{
                
    if(obj.id=='booking_from_location')
    {
        $('#origin_latitude').val('');
        $('#origin_longitude').val('');
        $('#origin').val('');

    }
    else if(obj.id=='booking_waypoint_1')
    {
        $('#w_latitude_1').val('');
        $('#w_longitude_1').val('');
        $('#waypoint_1').val('');
    }
    else if(obj.id=='booking_waypoint_2')
    {
        $('#w_latitude_2').val('');
        $('#w_longitude_2').val('');
        $('#waypoint_2').val('');
    }
    else if(obj.id=='booking_waypoint_3')
    {
        $('#w_latitude_3').val('');
        $('#w_longitude_3').val('');
        $('#waypoint_3').val('');
    }
    else if(obj.id=='booking_to_location')
    {
        $('#destination_latitude').val('');
        $('#destination_longitude').val('');
        $('#destination').val('');
    }
    calcRoute();
}
function clear_lat(obj)
{
                
    if(obj.id=='booking_from_location')
    {
        $('#origin_latitude').val('');
        $('#origin_longitude').val('');
        $('#origin').val('');

    }
    else if(obj.id=='booking_waypoint_1')
    {
        $('#w_latitude_1').val('');
        $('#w_longitude_1').val('');
        $('#waypoint_1').val('');
    }
    else if(obj.id=='booking_waypoint_2')
    {
        $('#w_latitude_2').val('');
        $('#w_longitude_2').val('');
        $('#waypoint_2').val('');
    }
    else if(obj.id=='booking_waypoint_3')
    {
        $('#w_latitude_3').val('');
        $('#w_longitude_3').val('');
        $('#waypoint_3').val('');
    }
    else if(obj.id=='booking_to_location')
    {
        $('#destination_latitude').val('');
        $('#destination_longitude').val('');
        $('#destination').val('');
    }
    calcRoute();
}
function clean_unused()
{
    if($('#origin').val()=='')
    {
        $('#booking_from_location').val('');
    }
    else if($('#waypoint_1').val()=='')
    {
        $('#booking_waypoint_1').val('');
    }
    else if($('#waypoint_2').val()=='')
    {
        $('#booking_waypoint_2').val('');
    }
    else if($('#waypoint_3').val()=='')
    {
        $('#booking_waypoint_3').val('');
    }
    else if($('#destination').val()=='')
    {
        $('#booking_to_location').val('');
    }
}
function delete_waypoint()
{
    $("#a_remove_waypoint_1").hide();
    $("#a_remove_waypoint_2").hide();
    $("#a_remove_waypoint_3").hide();

    var way_points=parseInt($('#total_waypoints').val());
    if(isNaN(way_points))
    way_points=0;

    if(way_points>0)
    {
        $('#dv_way_point_'+way_points).hide();
        $('#w_latitude_'+way_points).val('');
        $('#w_longitude_'+way_points).val('');
        $('#waypoint_'+way_points).val('');
        $('#booking_waypoint_'+way_points).val('');
        way_points=way_points-1;

        if(way_points>0)
        $("#a_remove_waypoint_"+way_points).show();
    }

    $('#total_waypoints').val(way_points);

    calcRoute();
    
}