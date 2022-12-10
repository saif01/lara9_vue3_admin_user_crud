<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;

class IndexController extends Controller
{
    //index
    public function index(){
        return view('test.index');
    }

    public function pdf(){
         $pdfData = [
            'title' => "You're Watching Snappy PDF",
            'date' => date('m/d/Y'),
            'copies_no' => 5,
        ];

        $timestamp = time(); 
        $name = $timestamp . '_test.pdf';
        //return view('pdf.mpdf', $data);
        $pdf = PDF::loadView('test.pdf', compact('pdfData'));
       
        return $pdf->download($name);
    }

    // ldap
    public function ldap(){

        $ldapHost = "10.64.1.3";
        // $ldapHost = "10.242.97.10";
        $ldapConn = @ldap_connect($ldapHost);
        ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);

        $connection = '';
        if ($ldapConn) {
            // Connection Ok
            $connection = "LDAP Connection OK";
        }else{
            $connection = "LDAP Connection Faild";
        }

        dd($connection);
    }

    // Oracle Ccnnection 
    public function oracle(){

        try {
         $responseQuery = DB::connection('oracle_db');
         dd("Connection Ok", $responseQuery);
        
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:<br><br>" . $e );
        }

    }

    public function phpinfo(){
        return view('test.phpinfo');
    }
}
