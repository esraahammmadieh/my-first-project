<?php

namespace App\Http\Controllers;
use  App\Models\Expert;
use App\Models\favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoritListController extends Controller
{
    public function fav($request)
    {
    if (favorite::find($request)===null) {
        // create Fav EXPERT
        $Favorite= new favorite();
        $Favorite->user_id=auth()->user()->id;
        $Favorite->expert_id= $request;
        //save
        $Favorite->save();
        //send Respone
        return response()->json([
            'message'=>'Expert add Favorite',
            'data '=>$Favorite,
            'stauts'=>1,
        ]);
    } else {
        return response()->json([
            "stauts"=>0,
            "message"=>"This Expert added before"]);
    }
}
    public function FavoriteExpert()
    {
        $show = Expert::with('Favorite')->get();
        return response()->json([
        "stauts"=>1,
        "message"=>"These All Expert",
        "data"=>$show
        ]);
    }

    public function unfav($id)
    {
        if (Expert::with('Favorite')!= null) {
            $user = favorite::where('id',$id)->delete();
            return response()->json([
            "stauts"=>1,
            "message"=>"Favorite Expert has Been Deleted",
            ]);
        } else {
            return response()->json([
            "stauts"=>0,
            "message"=>"This ID Invalid",
            ]);
        }
    }
}


