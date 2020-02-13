<?php

namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use App\Level;
use Illuminate\Validation\ValidationException;
use function foo\func;

class Projects extends Controller
{
    function list(Request $request){
        return response()->json(Project::all()->toArray());
    }

    function search(Request $request){

        $token = $request->header('Authorization');
        $user = Member::where('api_token',$token)->first()->toArray();
        $userLevel = Level::where('level',$user['level'])->first()->toArray();
        $search = $request->toArray();
        unset($search['token']);
        foreach ($userLevel as $key => $value){
            if(isset($search[$key]) && strlen($value)==2){
                if($value[0]=='S'){
                    unset($search[$key]);
                }else if($value[0]=='X'){
                    if(strlen($search[$key])<2){
                        unset($search[$key]);
                    }
                }
            }
        }
        if(!sizeof($search)){
            return response()->json(['error','Not enough condition for search']);
        }
        $data = Project::all()->toArray();

        foreach ($search as $key =>$value){
            $data = array_filter($data, function ($var) use ($key,$value) {
                return strpos(strtoupper($var[$key]),strtoupper($value))!== false;
            });
        }
        //return response()->json($userLevel);
        foreach ($userLevel as $key=>$value){
            if(strlen($value)==2 && $value[1]=='X'){
                foreach($data as &$item) {
                    if(isset($item[$key])){
                        unset($item[$key]);
                    }
                    unset($item);
                }
            }
        }

        return response()->json(array_values($data));
    }
}
