<?php

namespace App\Http\Controllers;
use App\Member;
use App\Level;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\MagicMethodTypeHintsPass;
use function Sodium\add;


class MemberAuth extends Controller
{
   /* public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $validatedData['password']=bcrypt($request->password);
        $validatedData['level']='3';
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);

    }

    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'email|required',
        ]);
        return response(['message','not valid login']);
       if(!auth()->attempt($loginData)){
           return response(['message','not valid login']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response([
            'user'=>auth()->user(),
            'token'=>$accessToken
        ]);

    }*/

    use ThrottlesLogins;
    protected function register(Request $request)
    {
        return Member::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' =>'0',
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        return $this->attempLogin($request);

    }
    public function logout(Request $request){
        $token = $request->header('Authorization');
        $user = Member::where('api_token',$token)->first();
        if($user){
            $api_token = Str::random(60);
            $user->api_token = $api_token;
            $user->save();
            return response()->json(['message'=>'logout success']);
        }else{
            return response()->json(['message'=>'logout fail']);
        }
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    protected function attempLogin(Request $request)
    {
        $this->incrementLoginAttempts($request);

        $user = Member::where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return $this->sendFailedLoginResponse($request);
        }

        // 更新 api_key
        $api_token = Str::random(60);
        $user->api_token = $api_token;
        $user->save();

        return $this->sendLoginResponse($request, $user);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }


    protected function sendLoginResponse(Request $request, Member $user)
    {
        $this->clearLoginAttempts($request);
        unset($user["updated_at"]);
        unset($user["created_at"]);
        unset($user["id"]);
        return Response()->make([
            'user' => $user,
            'token' => $user-> api_token
        ]);
    }

    public function username()
    {
        return 'email';
    }
    public function  me(Request $request){

        $token = $request->header('Authorization');
        $user = Member::where('api_token',$token)->first();
        $level = Level::where('level',$user['level'])->first();
        if(!$user){
            return response()->json(['error'=>'not valid token']);
        }else{
            return response()->json(['user'=>$user,'level'=>$level]);
        }
    }
}
