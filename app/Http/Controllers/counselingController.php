<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\DB;
class counselingController extends Controller
{
    //
    public function CreatCounseling(Request $request){
        //validate
            $request->validate([
                'name_of_counseling'=>['required','string'],
                'details'=>['required'],
            ]);
            // create data Counseling
            $Counseling= new Information();
            $Counseling->expert_id=auth()->user()->id;
            $Counseling->name_of_counseling=$request->name_of_counseling;
            $Counseling->details=$request->details;
            //save
            $Counseling->save();
            //send Respone
            return response()->json([
                'message'=>'Counseling created Succssefuly',
                'data of Counseling'=>$Counseling,
                'stauts'=>1,
            ]);
    }
    //الطلب الرابع من الطلبات الاجبارية
    //عرض كل التصنيفات
    public function ListCounseling(){
            $show = DB::table('informations')->
            select('name_of_counseling')
            ->distinct()->get();
            return response()->json([
            "stauts"=>1,
            "message"=>"These All counseling",
            "data"=>$show
            ]);
    }
        //الطلب الاول من الطلبات الاساسية
    public function SearchForCounsling($request)
    {
            $Expert= Information::with('Expert')->
            where('name_of_counseling',$request)->get();
            //send response
            return response()->json(["stauts"=>1,
            "message"=>"These data For Expert of this Counsling",
            "data"=>$Expert], 200);
    }
}

