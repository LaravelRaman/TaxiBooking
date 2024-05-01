var google_map=null;

function initMap() {
    var marker;
    var map = new google.maps.Map(document.getElementById('g_map'), {
        mapTypeControl: false,
        zoomControl: true,
        center: {lat: current_latitude, lng: current_longitude},
        zoom: 12,
        styles : [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#e4e8e9"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#7de843"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#9bd0e8"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]
    });

   	var oLatitudev = document.getElementById('origin_latitude').value;
    var oLongitudev = document.getElementById('origin_longitude').value;
    var dLatitudev = document.getElementById('destination_latitude').value;
    var dLongitudev = document.getElementById('destination_longitude').value;
   
   
    new AutocompleteDirectionsHandler(map,oLatitudev,oLongitudev,dLatitudev,dLongitudev);
	
	if( oLatitudev.length && oLongitudev.length &&  dLatitudev.length && dLongitudev.length ) {
		var polylineOptionsActual = new google.maps.Polyline({
            strokeColor: '#111',
            strokeOpacity: 0.8,
            strokeWeight: 4
		});
	
       directionsService = new google.maps.DirectionsService;

			
		directionsService.route({
			origin: new google.maps.LatLng(Number(oLatitudev), Number(oLongitudev)),
			destination: new google.maps.LatLng(Number(dLatitudev), Number(dLongitudev)),
			avoidTolls: true,
			avoidHighways: false,
			travelMode: google.maps.TravelMode.DRIVING
		}, function (response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
                calculateDistance();
			} else {
				window.alert('Directions request failed due to ' + status);
			}

		});
		
	}
    google_map=map;
}

/**
 * @constructor
 */

function AutocompleteDirectionsHandler(map,slat1,slong1,dlat1,dlong1) {
	let slat=0;
	let slong=0;
	let dlat = 0;
	let dlong = 0;
	var marker;
    this.map = map;
    this.originPlaceId = null;
    this.destinationPlaceId = null;
    this.waypointPlaceId1 = null;
    this.waypointPlaceId2 = null;
    this.waypointPlaceId3 = null;
    

    this.travelMode = 'DRIVING';
    
    var originInput = document.getElementById('booking_from_location');
    var destinationInput = document.getElementById('booking_to_location');
    var modeSelector = document.getElementById('mode-selector');
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
    

    var base_url =  window.location.origin;	
    var simage = base_url+'/asset/front/img/source.png';
    var dimage = base_url+'/asset/front/img/destination.png';
    var polylineOptionsActual = new google.maps.Polyline({
            strokeColor: '#111',
            strokeOpacity: 0.8,
            strokeWeight: 4
    });
     
    if( slat1.length !='' && slong1.length !='' &&  dlat1.length !='' && dlong1.length !='' ) {
       marker = new google.maps.Marker({
            position: new google.maps.LatLng(slat1, slong1),
            map: map,
            icon: simage
          });
       marker = new google.maps.Marker({
            position: new google.maps.LatLng(dlat1, dlong1),
            map: map,
            icon: dimage
          });
       directionsDisplay = new google.maps.DirectionsRenderer({map: map, suppressMarkers: true, polylineOptions: polylineOptionsActual });

   }
    this.directionsService = new google.maps.DirectionsService;

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
        show_markers()
        var place = originAutocomplete.getPlace();
        
        if (place.hasOwnProperty('place_id')) {
            if (!place.geometry) {
                    // window.alert("Autocomplete's returned place contains no geometry");
                    return;
            }
            originLatitude.value = place.geometry.location.lat();
            originLongitude.value = place.geometry.location.lng();
            slat = place.geometry.location.lat();
            slong = place.geometry.location.lng();
            $('#origin').val(place.formatted_address);
           
        } else {
            service.textSearch({
                    query: place.name
            }, function(results, status) {
            	
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    originLatitude.value = results[0].geometry.location.lat();
                    originLongitude.value = results[0].geometry.location.lng();
                    slat = results[0].geometry.location.lat();
                    slong = results[0].geometry.location.lng();
                    $('#origin').val(results[0].formatted_address);
                }
            });
        }
       /// alert(marker);
        if (marker && marker.setMap) {
           marker.setMap(null);
           // alert("h1");
           }
           marker = new google.maps.Marker({
            position: new google.maps.LatLng(slat, slong),
            map: map,
            icon: simage
          });
    });


    destinationAutocomplete.addListener('place_changed', function(event) {
    	show_markers()
        var place = destinationAutocomplete.getPlace();
       
        if (place.hasOwnProperty('place_id')) {
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            destinationLatitude.value = place.geometry.location.lat();
            destinationLongitude.value = place.geometry.location.lng();
            dlat = place.geometry.location.lat();
            dlong = place.geometry.location.lng();
            $('#destination').val(place.formatted_address);
        } else {
            service.textSearch({
                query: place.name
            }, function(results, status) {

                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    destinationLatitude.value = results[0].geometry.location.lat();
                    destinationLongitude.value = results[0].geometry.location.lng();
                    dlat = results[0].geometry.location.lat();
                    dlong = results[0].geometry.location.lng();
                    $('#destination').val(results[0].formatted_address);
                }
            });
        }
        if (marker && marker.setMap) {
           marker.setMap(null);
           // alert("h2");
           }
         // markers[0].setMap(null);
         // alert(marker);
         var marker = new google.maps.Marker({
            position: new google.maps.LatLng(dlat, dlong),
            map: map,
            icon: dimage
          });

    });
    
    var waypointAutocomplete1 = new google.maps.places.Autocomplete(waypointInput1,options);
        waypointAutocomplete1.addListener('place_changed', function(event) {
            show_markers()
            var place = waypointAutocomplete1.getPlace();

            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                        // window.alert("Autocomplete's returned place contains no geometry");
                        return;
                }
                waypointLatitude1.value = place.geometry.location.lat();
                waypointLongitude1.value = place.geometry.location.lng();
                $('#waypoint_1').val(place.formatted_address);
            
            } 
            else {
                service.textSearch({
                        query: place.name
                }, function(results, status) {
                    
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        waypointLatitude1.value = results[0].geometry.location.lat();
                        waypointLongitude1.value = results[0].geometry.location.lng();
                        $('#waypoint_1').val(results[0].formatted_address);
                    }
                });
            }
            if (marker && marker.setMap) {
                marker.setMap(null);
            // alert("h1");
            }
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(waypointLatitude1.value, waypointLongitude1.value),
                map: map,
                icon: simage
            });
    });
         var waypointAutocomplete2 = new google.maps.places.Autocomplete(
        waypointInput2,options);
        waypointAutocomplete2.addListener('place_changed', function(event) {
            show_markers()
            var place = waypointAutocomplete2.getPlace();

            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                        // window.alert("Autocomplete's returned place contains no geometry");
                        return;
                }
                waypointLatitude2.value = place.geometry.location.lat();
                waypointLongitude2.value = place.geometry.location.lng();
                $('#waypoint_2').val(place.formatted_address);
            
            } else {
                service.textSearch({
                        query: place.name
                }, function(results, status) {
                    
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        waypointLatitude2.value = results[0].geometry.location.lat();
                        waypointLongitude2.value = results[0].geometry.location.lng();
                        $('#waypoint_2').val(results[0].formatted_address);
                    }
                });
            }
            if (marker && marker.setMap) {
                marker.setMap(null);
                // alert("h1");
                }
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(waypointLatitude2.value, waypointLongitude2.value),
                    map: map,
                    icon: simage
                });
        });
    var waypointAutocomplete3 = new google.maps.places.Autocomplete(
        waypointInput3,options);
        waypointAutocomplete3.addListener('place_changed', function(event) {
            show_markers()
            var place = waypointAutocomplete3.getPlace();

            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                        // window.alert("Autocomplete's returned place contains no geometry");
                        return;
                }
                waypointLatitude3.value = place.geometry.location.lat();
                waypointLongitude3.value = place.geometry.location.lng();
                $('#waypoint_3').val(place.formatted_address);
            
            } else {
                service.textSearch({
                        query: place.name
                }, function(results, status) {
                    
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        waypointLatitude3.value = results[0].geometry.location.lat();
                        waypointLongitude3.value = results[0].geometry.location.lng();
                        $('#waypoint_3').val(results[0].formatted_address);
                    }
                });
            }
            if (marker && marker.setMap) {
                marker.setMap(null);
                // alert("h1");
                }
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(waypointLatitude3.value, waypointLongitude3.value),
                    map: map,
                    icon: simage
                });
        });
    

    this.directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true, polylineOptions: polylineOptionsActual});
    this.directionsDisplay.setMap(map);
    this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
    this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
    this.setupPlaceChangedListener(waypointAutocomplete1, 'WAYPOINT1');
    this.setupPlaceChangedListener(waypointAutocomplete2, 'WAYPOINT2');
    this.setupPlaceChangedListener(waypointAutocomplete3, 'WAYPOINT3');
    add_waypoint(0);

}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
    var me = this;
    autocomplete.bindTo('bounds', this.map);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.place_id) {
            // window.alert("Please select an option from the dropdown list.");
            return;
        }
        if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
        } else if(mode == 'DEST'){
            me.destinationPlaceId = place.place_id;
        }
        else if(mode == 'WAYPOINT1'){
            me.waypointPlaceId1 = place.place_id;
        }
        else if(mode == 'WAYPOINT2'){
            me.waypointPlaceId2 = place.place_id;
        }
        else if(mode == 'WAYPOINT3'){
            me.waypointPlaceId3 = place.place_id;
        }
        me.route();
    });

};

AutocompleteDirectionsHandler.prototype.route = function() {
    if (!this.originPlaceId || !this.destinationPlaceId) {
        return;
    }
    
    var me = this;

    var waypoints=[];

    var way_points=parseInt($('#total_waypoints').val());
    if(isNaN(way_points))
    way_points=0;
    debugger;
    for(w=1;w<=way_points;w++)
    {
        /*if(w==1)
        waypoints.push({location:me.waypointPlaceId1,stopover:false}); 
        if(w==2)
        waypoints.push({location:me.waypointPlaceId2,stopover:false}); 
        if(w==3)
        waypoints.push({location:me.waypointPlaceId3,stopover:false}); */
        waypoints.push({location:new google.maps.LatLng($('#w_latitude_'+w).val(),$('#w_longitude_'+w).val()),stopover:false}); 
    }

    

    this.directionsService.route({
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode,
        waypoints: waypoints,
        optimizeWaypoints: false,
        
    }, function(response, status) {
        if (status === 'OK') {
            me.directionsDisplay.setDirections(response);
            calculateDistance();
        } else {
            // window.alert('Directions request failed due to ' + status);
        }
    });
};

function calculateDistance()
{
    var origin =$('#origin').val();
    var destination =$('#destination').val();
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [origin],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.metric, //IMPEARIAL for miles/feet
        avoidHighways: false,
        avoidTolls: false
    },distanceCallback);

    

}
function distanceCallback(response,status){
    $('#dvDistance').html(0+' km');
    $('#dvDuration').html('0 h 0 m');
    $('#distance').val(distance_in_kilo);
    $('#duration').val(duration_value);
    if(status != google.maps.DistanceMatrixStatus.OK)
    {
        //alert('error');
    }
    else{
        var origin=response.originAddresses[0];
        var destination=response.destinationAddresses[0];
        if(response.rows[0].elements[0].status === "ZERO_RESULTS"){
            //alert('error');  
        }
        else{
            var distance = response.rows[0].elements[0].distance;
            var duration = response.rows[0].elements[0].duration;

            var distance_in_kilo = parseFloat((distance.value/1000).toFixed(1));
            var distance_in_miles = distance.value/1609.34;
            
            var duration_text = duration.text;
            var duration_value = duration.value;

            $('#dvDistance').html(distance_in_kilo+' km');
            $('#dvDuration').html(duration_text); 
            $('#distance').val(distance_in_kilo);
            $('#duration').val(duration_value);
            change_duration();

        }
    }

    
}

function change_duration()
{
    var duration_value=parseInt($('#duration').val());
    if(isNaN(duration_value))
    {
        duration_value=0;
    }
    var booking_extra_hours=parseInt($('#booking_extra_hours option:selected').val());
    if(isNaN(booking_extra_hours))
    {
        booking_extra_hours=0;
    }
    var hours=Math.floor(duration_value/3600);
    var mins=Math.round((duration_value-hours*3600)/60,0);
    hours=hours+booking_extra_hours;
    $('#dvDuration').html(hours+' h '+mins+' m');
}


function add_waypoint(wt)
{
    
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
    }
    $('#total_waypoints').val(way_points);
    
}
function show_markers()
{


    
    var marker;
   // alert(slat1);
   var base_url =  window.location.origin;
   var simage = base_url+'/asset/front/img/source.png';
    var dimage = base_url+'/asset/front/img/destination.png';
    var polylineOptionsActual = new google.maps.Polyline({
            strokeColor: '#111',
            strokeOpacity: 0.8,
            strokeWeight: 4
    });
   if( $('#origin_latitude').val() !='' && $('#origin_longitude').val() !='' &&  $('#destination_latitude').val() !='' && $('#destination_longitude').val() !='' ) {
       marker = new google.maps.Marker({
            position: new google.maps.LatLng($('#origin_latitude').val(), $('#origin_longitude').val()),
            map: google_map,
            icon: simage
          });
          
          
          
          
       marker = new google.maps.Marker({
            position: new google.maps.LatLng($('#destination_latitude').val(), $('#destination_longitude').val()),
            map: google_map,
            icon: dimage
          });
       directionsDisplay = new google.maps.DirectionsRenderer({map: google_map, suppressMarkers: true, polylineOptions: polylineOptionsActual });

   }
}