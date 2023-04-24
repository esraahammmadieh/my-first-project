<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expert;
use App\Models\Information;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpertController extends Controller
{
    //الطلب الثاني من الطلبات الاساسية
    public function SingleExpert($Expertid)
    {
        if (Expert::where("id", $Expertid)->exists()) {
            $expert_id=Expert::find($Expertid);
            return response()->json([
            "stauts"=>1,
            "message"=>"These data For Expert",
            "data"=>$expert_id
            ]);
        }
        else {
            return response()->json([
            "stauts"=>0,
            "message"=>"This Expert Not Found",
            ]);
        }
    }

        //الطلب الرابع من الطلبات الاجبارية
        //عرض الخبراء حسب اسم التصنيف
        public function ExpertForCounsling($request)
        {
            $Expert=Information::
            where('name_of_counseling',
            'like', "%$request%")->
            with('expert')->get();
            //send Response
            return response()->json([
            "stauts"=>1,
            "message"=>"These Counsling exists of these experts",
            "data"=>$Expert]
            , 200);
            }
    //الطلب الاول من الطلبات الاساسية
        public function SearchForExpert($request)
        {
            $Expert= Expert::with('informations')->
            where('fname',$request)->get();
            //send Response
            return response()->json([
            "stauts"=>1,
            "message"=>"These data For Expert",
            "data"=>$Expert]
            , 200);
            }
            public function ShowAllExpert(){
            $Exerts=Expert::get()->all();
            return response()->json([
            "stauts"=>1,
            "message"=>"These data For  All Expert",
            "data"=>$Exerts]
            , 200);

            }

}

