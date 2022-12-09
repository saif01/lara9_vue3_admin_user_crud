<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\Common\ADLogin;

class APIAuthController extends Controller
{
    //index
    public function index(Request $request){
        $login      = $request->login;
        $password   = $request->pass;

        $response = [
            'code' => 400,
            'status' => 'error',
            'msg' => 'Parameter Error',
            'data' => null,
        ];

        if($login && $password){
            // return $login.'--'.$password;
            // Login Check By AD
           $adResponse = ADLogin::Data($login, $password);
           if($adResponse->status == 'success'){

                // AD response data
                $adData     = $adResponse->data;

                // dd($adData, $localData);

                // $data = [];

                // $data['UserName']             = $adData->UserName;
                // $data['Department']       = $adData->Department;
                // $data['OfficeID']        = $adData->OfficeID;
                // $data['OfficeMobile']   = $adData->OfficeMobile;
                // $data['PersonalMobile'] = $adData->PersonalMobile;
                // $data['OfficeEmail']     = $adData->OfficeEmail;
                // $data['PersonalEmail']   = $adData->PersonalEmail;
                // $data['Office']           = $adData->Office;
                // $data['Office']      = $adData->Office;
                // $data['business_unit']    = $adData->BusinessUnit;
                // $data['nid']              = $adData->NationalID;
                

                $response = [
                    'code' => 200,
                    'status' => 'success',
                    'msg' => 'Data Found',
                    'data' => $adData,
                ];
                return $response;

            }else{

                $response = [
                    'code' => 401,
                    'status' => 'error',
                    'msg' => 'Data Not Found',
                    'data' => null,
                ];

                return $response;
            }

        }else{
            return $response;
        }
    }
}
