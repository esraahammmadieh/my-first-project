<?php

namespace App\Http\Controllers;
use  App\Models\Expert;
use App\Models\rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    //
    public function Rating($id, Request $request)
    {
        {
            //Rating Expert
            $request->validate([
                'numrating'=>['required','min:1','max:5'],
            ]);

            $rate= new rating();
            $rate->user_id=auth()->user()->id;
            $rate->expert_id= $id;
            $rate->numrating=$request->numrating;
            //save
            $rate->save();
            //send Respone
            return response()->json([
                'message'=>'Rating this Expert',
                'data '=>$rate,
                'stauts'=>1,
            ]);
        }}
        //Showing Rating
        public function ShowRating($id){
        $ratingCount = DB::table('_ratings')
        ->where('expert_id', $id)
        ->count();

        $averageRating = DB::table('_ratings')
        ->where('expert_id', $id)
        ->avg('numrating');

        $ExpertRating =rating::with('Expert')->
        where('expert_id', $id)->distinct()->get();

        $data = [
        "ratingCount" => $ratingCount,
        "averageRating" => $averageRating,
        "Expert"=>$ExpertRating

        ];
        return response()->json([
                'message'=>'The Avg Rating For this Expert',
                'data '=>$data,
                'stauts'=>1,
            ]);
        }


}

