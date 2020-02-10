<?php

namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use Illuminate\Validation\ValidationException;

class Projects extends Controller
{
    function list(Request $request){

       /* $collection = collect(['account_id' => 1, 'product' => 'Desk']);

        if($collection->has('Desk')){
            return response()->json(['error'=>'valid']);
        }else{
            return response()->json(['error'=>'no valid']);
        }*/

        return response()->json(Project::all());


        $token = $request['token'];
        $v = collect(Member::where('api_token',$token)->get());

        if(json($v)->has('name')){
            return response()->json(Project::all());
        }else{
            return response()->json(['error'=>'not valid']);
        }

    }


    function search(Request $request){


            $programName = $request->input('programName');
            $partNumber = $request->input('partNumber');
            $sale = $request->input('sales');
            $cn = $request->input('cn-customerName');


            $data = Project::where('programName','LIKE', '%'.$programName.'%')
                ->where('partNumber','LIKE', '%'.$partNumber.'%')
                ->get();
            return response()->json($data);





    }



}
