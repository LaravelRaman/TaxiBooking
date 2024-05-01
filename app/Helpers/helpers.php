<?php
    use App\Models\VehicleType;
    use App\Models\Service;

    if (! function_exists('get_min_time')) {

        function get_min_time(){
            return date('H:i',strtotime('+30 min',strtotime(date('Y-m-d H:i'))));
        }
    }
    if (! function_exists('fleet')) {

        function fleet(){
            $fleet=VehicleType::all();
            return $fleet;
        }
    } 
    
    if (! function_exists('services')) {

        function services(){
            $services = Service::where('status','Active')->orderBy('sno','ASC')->get();
            // $services=json_decode(json_encode(
            //     array(
            //         array(
            //         'name'=> 'SYDNEY AIRPORT TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'CORPORATE TRANSFER',
            //         ),
            //         array(
            //         'name'=> 'SPECIAL EVENT TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'SPORTING EVENT TRANSFER',
            //         ),
            //         array(
            //         'name'=> 'WEDDINGS CARS SYDNEY',
            //         ),
            //         array(
            //         'name'=> 'RED CARPET EVENTS',
            //         ),
            //         array(
            //         'name'=> 'SYDNEY CONFERENCE TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'CRUISE SHIP TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'CASINO TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'PRIVATE WINE TOURS',
            //         ),
            //         array(
            //         'name'=> 'MEDIA AND PRODUCT LAUNCHES TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'SEMINARS AND EXPO\'S TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'SCHOOL FORMAL CAR HIRE',
            //         ),
            //         array(
            //         'name'=> 'STATE WIDE TRANSFER',
            //         ),
            //         array(
            //         'name'=> 'FUNERAL TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'NATION WIDE TRANSFERS',
            //         ),
            //         array(
            //         'name'=> 'HENS AND BUCKS PARTY TRANSFER',
            //         ),
                    
            //     )
            // ),FALSE);
            return $services;
        }
    }

    if (! function_exists('get_extra_hours')) {

        function get_extra_hours(){
            return range(1,12);
        }
    }