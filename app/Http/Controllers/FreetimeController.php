<?php

namespace App\Http\Controllers;
use App\Models\freetimes_time;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FreetimeController extends Controller
{
    public function inputfreetime(Request $request)//الخبير يدخل مواعيدة المتاحة
        {
            $request->validate([
            'day'=>['required','string'],
            'start_time'=>['date_format:H:i','required'],
            'end_time'=>['date_format:H:i','after:start_time','required']]);
                $freetime= freetimes_time::query()->create([
                'expert_id'=>Auth::id(),
                'day'=>$request->day,
                'start_time'=>$request->start_time,
                'end_time'=>$request->end_time
                ]);
                if(!$freetime)
            {
                return response()->json([
                    'success'=>false,
                    'message'=>'registration failed'
                ]);
            }
                return response()->json([
                'success'=>$freetime
            ]);
}

        public function showallfreetimeofcertainexpert($id)//رؤية المواعيد المتاحة للمستخدم
        {
        $allfreetime= DB::table('freetimes_time')->where('expert_id',$id)->get();
        if (!$allfreetime) {
        return response()->json([
        'message'=>'error']);
        }
            return response()->json([
            'success'=>$allfreetime
            ]);
    }

    public function select_appointment($id)//تابع حجز مستخدم لموعد
    {
            $money=DB::table('users')->where('id',Auth::id())->pluck('money')->first();
            $start_time=DB::table('freetimes_time')->where('id',$id)->pluck('start_time')->first();
            $end_time=DB::table('freetimes_time')->where('id',$id)->pluck('end_time')->first();
            $from=Carbon::parse($start_time);
            $to=Carbon::parse($end_time);
            $diff=$from->diffInMinutes($to);
        if(($money>=2000)&&($diff>=60))
        {
            $money=$money-2000;
            User::where('id',Auth::id())->update(['money'=> $money]);
            $newstarttime=Carbon::parse($start_time)->addHour();
            freetimes_time::where('id',$id)->update(['start_time'=> $newstarttime]);
            $expertid=DB::table('freetimes_time')->where('id',$id)->pluck('expert_id')->first();
            $day=DB::table('freetimes_time')->where('id',$id)->pluck('day')->first();
            $time=DB::table('freetimes_time')->where('id',$id)->pluck('start_time')->first();
            $shedule= Schedule::query()->create([
            'user_id'=>Auth::id(),
            'expert_id'=>$expertid,
            'day'=>$day,
            'time'=>$time
            ]);
            return response()->json([
            'success'=>$shedule
            ]);
            }
        else
        {
            return response()->json([
            'message'=>'failed'
                ]);
        }
        }
    public function  shedulesexpert()//الخبير جميع مواعيده المحجوزة
    {
        $shedules=DB::table('shedules')->where('expert_id',Auth::id())->get();
        if(!$shedules)
            {
                return response()->json([
                'message'=>'no shedules']);
            }
            
                return response()->json([
                'message'=>$shedules]);
    }
}

