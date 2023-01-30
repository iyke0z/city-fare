<?php
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Http\Resources\User\DriverResource;
use App\Http\Resources\User\UserCollection;
use App\Models\PackageCodes;
use App\Models\PayAsYouGoCodes;
use App\Models\UserTrip;

// package_code_generator using hash hash today's date
if (!function_exists('random_strings')) {
    function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shuffle the $str_result and returns substring of specified length
        return substr(str_shuffle($str_result),
                        0, $length_of_string);
    }

}

if (!function_exists('generate_trip_num')) {
    function generate_trip_num()
    {
        $num = mt_rand(1000000000, 9999999999);
        $check = PayAsYouGoCodes::where('code', $num)->first();

        if (!$check) {
            return "CTF$num";
        }
    }

}

if (!function_exists('generate_package_code')) {
    function generate_package_code()
    {
        $num = mt_rand(1000000000, 9999999999);
        $check = PayAsYouGoCodes::where('code', $num)->first();

        if (!$check) {
            return "CTF$num";
        }
    }

}

if (!function_exists('generate_user_code')) {
    function generate_user_code()
    {
        $num = mt_rand(1000000000, 9999999999);
        $check = UserTrip::where('trip_no', $num)->first();

        if (!$check) {
            return "CFU$num";
        }
    }

}

if (!function_exists('get_user_details')) {
    function get_user_details($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

}

if (!function_exists('get_all_user_details')) {
    function get_all_user_details()
    {
        $user = User::all();

        return $user;
    }

}

if (!function_exists('get_driver_details')) {
    function get_driver_details($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }
}

if (!function_exists('get_all_driver_details')) {
    function get_all_driver_details()
    {
        $user = User::all();

        return $user;
    }

}

if (!function_exists('hashString')){
    function hashString($string) {
        $h = 4;
        $letters = ['a','c','d','e','g','i','l','m','n','o','p','r','s','t','u','w','y'];
        $string = str_split($string);
        for ($index = 0; $index < count($string); $index++) {

            $h = ($h * 37 + array_search($string[$index], $letters));
        }
        echo $h;
    }
}

if (!function_exists('convert_array_of_numbers_to_string')){
    function convert_array_of_numbers_to_string($num_array) {
        $string = [];
        $letters = ['a','c','d','e','g','i','l','m','n','o','p','r','s','t','u','w','y'];
        for ($index = 0; $index < count($num_array); $index++) {
            array_push($string, $letters[$num_array[$index]]);
        }
        $string = array_reverse($string);
        $string = implode($string);
        echo $string;
    }
}

if (!function_exists('unHashString')){
    function unHashString($number) {
        /*
            steps:
            create an array to hold modulo results
            initialize num = number
            perform a loop to get the modulo of the new result from number/37
            get modulo of result and push to array(text)
        */
        $text = [];
        $num = $number;
        $mod = $num % 37;
        array_push($text, intval($mod)); // 2)
        for ($index = 0; $index < 4 - 1; $index++) {
            $num = $num / 37;
            $mod = $num % 37;
            array_push($text, intval($mod)); // 2)
        }
        convert_array_of_numbers_to_string($text);
    }
}


