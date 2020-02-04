<?php

namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Project;
class Projects extends Controller
{
    function list(){
        return response()->json(Project::all());
    }

    function result(){
        return Project::all();
    }
    function search(Request $request){

        $programName = $request->input('programName');
        $partNumber = $request->input('partNumber');
        $sale = $request->input('sales');
        $cn = $request->input('cn-customerName');


        $data = Project::where('programName','LIKE', '%'.$programName.'%')
            ->where('cn-customerName','LIKE', '%'.$cn.'%')
            ->get();
        return response()->json($data);


    }



}
