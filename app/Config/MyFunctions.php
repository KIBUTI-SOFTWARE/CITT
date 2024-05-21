<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use App\Models\MembersModel;
use App\Models\ProjectsModel;
use App\Models\CollegesModel;

/**
 * My Defined Functions.
 */
class MyFunctions extends BaseConfig
{
    
    public static function generateID()
    {
        $date = date('ymd');
        $rand = substr(rand(1000000, 9999999), 0, 4);
        $queryTime = substr($_SERVER["REQUEST_TIME_FLOAT"], -5, 5);

        $queryT = str_replace('.', '0', $queryTime);
        $id = $date.str_shuffle($rand).($queryT);

        return $id;
    }

    public static function generateNumberOTP(){
        return rand(100000, 999999);
    }
    
    public static function sendOTP($receiver_phone, $otp){
        $url = "https://emessage.plab.tech/api/send-message";
        $receiver_phone = strval('+255'.ltrim($receiver_phone, "0"));
        $body = [
            "apiKey" => "31fa6e9d1f5a6261ea72f61e6c15e6",
            "vendor" => "BISHAMBA",
            "message" => "Hi,\nYour password recovery OTP code is $otp.",
            "receivers" => ["$receiver_phone"],
        ];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body) );
        $headers = array(
            "Content-Type: application/json"
         );
         curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
         
        $results = curl_exec($curl);
    
        return $results;
        
    }

    public static function getMemberDetails($member)
    {
        $conn = db_connect();
        $model = new MembersModel($conn);

        $member_details = $model->getMemberDetails($member);

        return $member_details;
    }

    public static function getProjectDetails($project)
    {
        $conn = db_connect();
        $model = new ProjectsModel($conn);

        $project_details = $model->getProject($project);

        return $project_details;
    }

}
