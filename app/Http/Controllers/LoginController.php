<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function userRegister(Request $request){
    $request->validate([
        'fname'=>['required','max:55'],
        'lname'=>['required','max:55'],
        'email'=>['required','max:55','email'],
        'password'=>['required'],

    ]);

    $input=$request->all();
    $input['password']=bcrypt( $input['password']);
    $input['activation_token']=Str::random('60');
    $user=User::query()->create($input);
    $accessToken=$user->createToken('My App',['user'])->accessToken;
    return response()->json(['user'=>$user,
                            'accessToen'=>$accessToken]);
    }

    //userLogin

    public function userLogin(Request $request):JsonResponse{
        $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);
        $credit=request(['email','password']);
        if(auth()->guard('user')->attempt( $request->only('email','password'))){
        config(['auth.guards.api.provider'=>'user']);
        $user=User::query()->find(auth()->guard('user')->user()['id']);
        $success=$user;
        $success['token'] = $user->createToken('My App',['user'])->accessToken;
        return response()->json($success);
    }
    else{
        return response()->json(['error'=>['Unauthroized'],401]);
    }
}

    //log out user
    public function LogoutUser():JsonResponse{
        Auth::guard('user-api')->user()->token()->revoke();
        return response()->json(['success'=>'loggoued Out Succsseful']);
    }



    //Registr Expert
public function expetRegister(Request $request){
    $request->validate([
        'fname'=>['required','max:55'],
        'lname'=>['required','max:55'],
        'email'=>['required','max:55','email'],
        'image_url'=>['required'],
        'password'=>['required'],
        'Phone'=>['required','max:10'],
        'Address'=>['required']
    ]);

        $input=$request->all();
        $input['password']=bcrypt( $input['password']);
        $input['activation_token']=Str::random('60');
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $extintion=$image->getClientOriginalExtension() ;
            $filename=time().'.'.$extintion;
            $image->move('public/images/',$filename);
            $input['image_url']=$filename;
        }
        $expert=Expert::query()->create($input);
        $accessToken=$expert->createToken('My App',['expert'])->accessToken;
        return response()->json(['expert'=>$expert,
                                'accessToen'=>$accessToken]);
        }

    //expertLogin
    public function expertLogin(Request $request):JsonResponse{
        $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);
        $credi=request(['email','password']);
        if(auth()->guard('expert')->attempt($request->only('email','password'))){
        config(['auth.guards.api.provider'=>'expert']);
        $expert=Expert::query()->find(auth()->guard('expert')->user()['id']);
        $succes=$expert;
        $succes['token'] = $expert->createToken('My App',['expert'])->accessToken;
        return response()->json( $succes);
    }
    else{
        return response()->json(['error'=>['Unauthroized'],401]);
    }
}
//logout Expert
    public function Logoutexpert():JsonResponse{
        Auth::guard('expert-api')->user()->token()->revoke();
        return response()->json(['success'=>'loggoued Out Succsseful']);
    }
    }

