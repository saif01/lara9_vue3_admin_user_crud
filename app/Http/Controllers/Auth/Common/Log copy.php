<?php

namespace App\Http\Controllers\Auth\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\Common\DeviceInfo;
use App\Models\UserLoginLog;
use Carbon\Carbon;
use App\Http\Controllers\Common\ScheduleCheck;
use Illuminate\Support\Facades\Auth;
use Ipify\Ip;

class Log extends Controller
{

    // Store
    public static function Store( $login_id='', $status='' ){

        
        // dd($info, $info->country, $info->city, $info->lat, $info->lon, $info->isp );
        
        

        // $IP = DeviceInfo::get_ip();
        // $IP = DeviceInfo::get_api_ip();
        // $OS = DeviceInfo::get_os();
        // $Browser = DeviceInfo::get_browser();
        // $Device  = DeviceInfo::get_device();

        $IP = DeviceInfo::get_api_ip();

        $info = DeviceInfo::user_ip_details($IP);

        $OS = DeviceInfo::get_os();
        $Browser = DeviceInfo::get_browser();
        $Device  = DeviceInfo::get_device();


        $data = new UserLoginLog();
        $data->login_id     =  $login_id;
        $data->status       =  $status;
        $data->ip           =  $IP;
        $data->os           =  $OS;
        $data->browser      =  $Browser;
        $data->device       =  $Device;

        $data->city         =  $info->city;
        $data->region       =  $info->region;
        $data->country      =  $info->country;
        $data->lat          =  $info->lat;
        $data->lon          =  $info->lon;
        $data->isp          =  $info->isp;
        $data->save();

        
        //$today   = Carbon::today();
        $today   = date("l jS \of F Y h:i:s A"); 
        $message = "#Error: $today, %0A";
        if( $status == 3 ){
            // AD Server Error
            $message .= "Not authorized AD, %0A ID : $login_id";
            $message .= ", %0A IP: $IP, %0A OS: $OS, %0A Browser: $Browser, %0A Device: $Device";
            self::lineMsg($message);
        }elseif( $status == 2 ){
            //code 2 user blocked
            $message .= "Blocked Login CPB-IT, %0A ID : $login_id";
            $message .= ", %0A IP: $IP, %0A OS: $OS, %0A Browser: $Browser, %0A Device: $Device";
            self::lineMsg($message);
        }
        elseif( $status == 0 ){
            //code 0 Not authorized CPB-IT
            $message .= "Not authorized CPB-IT, %0A ID : $login_id";
            $message .= ", %0A IP: $IP, %0A OS: $OS, %0A Browser: $Browser, %0A Device: $Device";
            self::lineMsg($message);
        }
        
        
        // dd( $message);
        return true;
       
    }


    // LogoutLog
    public static function LogoutLog(){

        $login_id = Auth::user()->login;
        $data = UserLoginLog::where('login_id', $login_id)->orderBy('id', 'desc')->first();

        //Current time
        if($data){
            $data->updated_at   =  date('Y-m-d H:i:s');
            $data->save();
        }
        return true;
    }

    //test
    public function test(){

        //$IP = Ip::get();

        // $ DeviceInfo:: user_ip_details

        // dd($IP);

        $info = DeviceInfo::user_ip_details();
        dd($info, $info->country, $info->city, $info->lat, $info->lon, $info->isp );
    }


    

    //Line Message send
    public static function lineMsg($message)
    {
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        // SSL USE
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        //POST
        curl_setopt($chOne, CURLOPT_POST, 1);
        // Message
        curl_setopt($chOne, CURLOPT_POSTFIELDS, $message);
        //��ҵ�ͧ�������ػ ������ 2 parameter imageThumbnail ���imageFullsize
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$message");
        // follow redirects
        curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);

        // //Test Group
        // $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.config('values.line_test_key'),);  // ��ѧ����� Bearer ��� line authen code �

        //Car Booking Group
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.config('values.line_login_log_key'),);  // ��ѧ����� Bearer ��� line authen code � env('APP_DEBUG')
        
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        //RETURN
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);

        //Check error
        if (curl_error($chOne)) {
            echo 'error:' . curl_error($chOne);
        } else {
            $result_ = json_decode($result, true);

            //************Status Print *************//

            //echo "status : ".$result_['status']; echo "message : ". $result_['message'];
            //echo "SMS send Successfully";
        }
        //Close connect
        curl_close($chOne);
    }
}
