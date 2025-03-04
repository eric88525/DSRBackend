<?php

namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use App\Level;
use Illuminate\Validation\ValidationException;
use function foo\func;
use function Sodium\add;

class ProjectController extends Controller
{
    function list(Request $request){
        return response()->json(Project::all()->toArray());
    }
    function  detail($opportunity,Request $request){
        $token = $request->header('Authorization');
        $user = Member::where('api_token',$token)->first()->toArray();
        $userLevel = Level::where('level',$user['level'])->first()->toArray();
        $datas = Project::where('opportunity',$opportunity)->get()->toArray();
        if(!$datas){
            return response()->json(['error'=>'opportunity not correct']);
        }
        $parts = array();
        if($userLevel['partNumber'][1] == 'G'){
            foreach ($datas as $i){
                array_push($parts,['partNumber'=>$i['partNumber'],'unitPrice'=>$i['unitPrice']]);
            }
        }
        $data = $datas[0];
        foreach ($userLevel as $key => $value) {
            if (isset($data[$key]) && strlen($value) == 2 ) {
                if ($value[1] != 'G') {
                    unset($data[$key]);
                }
            }else{
                unset($data[$key]);
            }
        }
        unset($data['partNumber']);
        unset($data['unitPrice']);
        if($userLevel['partNumber'][1] == 'G'){
            return response()->json([
                'project'=>$data,
                'partNumbers'=>$parts
            ]);
        }else{
            return response()->json([
                'project'=>$data,
            ]);
        }
    }


    function search(Request $request){
        # 拿到驗證
        $token = $request->header('Authorization');
        # 確認身分和階級
        $user = Member::where('api_token',$token)->first()->toArray();
        $userLevel = Level::where('level',$user['level'])->first()->toArray();
        $search = $request->toArray();
        unset($search['token']);

        # 把超出權限的搜索給消除
        foreach ($userLevel as $key => $value){
            if(isset($search[$key])){
                if($value[0]=='X'){
                    unset($search[$key]);
                }else if($value[0]=='S'){
                    if(strlen($search[$key])<2){
                        unset($search[$key]);
                    }
                }
            }else{
                unset($search[$key]);
            }
        }
        # 沒東西搜掰掰
        if(!sizeof($search)){
            return response()->json(['error'=>'Not enough condition for search']);
        }

        $first_value=reset($search);
        $first_key = key($search);

        # 拿資料並搜索排序
        $data = Project::where($first_key,'like','%'.$first_value.'%')->orderby('programName')->get()->toArray();
        foreach ($search as $key =>$value){
            if($value) {
                $data = array_filter($data, function ($var) use ($key, $value) {
                    return strpos(strtoupper($var[$key]), strtoupper($value)) !== false;
                });
            }
        }
        if(!$data){
            return response()->json(['error'=>'No match result']);
        }
        # 整理資料(這時還會有重複的)
        $data = array_values($data);
        $result = array();
        foreach ($data as $d){
            array_push($result,[
                'programName'=>$d['programName'],
                'opportunity'=>$d['opportunity']
            ]);
        }
        return response()->json($result);
    }
}
