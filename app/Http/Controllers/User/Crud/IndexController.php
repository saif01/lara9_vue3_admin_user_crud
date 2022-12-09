<?php

namespace App\Http\Controllers\User\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class IndexController extends Controller
{
    //index
    public function index(){

        // $paginate       = Request('paginate', 10);
        // $search         = Request('search', '');
        // $sort_direction = Request('sort_direction', 'desc');
        // $sort_field     = Request('sort_field', 'id');

        $allData = Test::get();

        return response()->json($allData, 200);

    }


    // store
    public function store(Request $request){


        //Validate
        $this->validate($request,[
            'name'       => 'required|string|max:100',
            'email'       => 'required|string|max:100',
        ]);

        $data = new Test();


        $data->name      = $request->name;
        $data->email     = $request->email;
        $success         = $data->save();

        if($success){
            return response()->json(['msg'=>'Stored Successfully &#128513;', 'icon'=>'success'], 200);
        }else{
            return response()->json([
                'msg' => 'Data not save in DB !!'
            ], 422);
        }

    }


    // update
    // public function update(Request $request, $id){

    //     //Validate
    //     $this->validate($request,[
    //         'name_en'       => 'required|string|max:100',
    //         'name_bn'       => 'required|string|max:100',
    //     ]);

    //     $data = ProductType::find($id);


    //     $data->name_en      = $request->name_en;
    //     $data->name_bn      = $request->name_bn;
    //     $data->created_by   =  Auth::user()->id;
    //     $success            = $data->save();

    //     if($success){
    //         return response()->json(['msg'=>'Updated Successfully &#128515;', 'icon'=>'success'], 200);
    //     }else{
    //         return response()->json([
    //             'msg' => 'Data not save in DB !!'
    //         ], 422);
    //     }

    // }
}
