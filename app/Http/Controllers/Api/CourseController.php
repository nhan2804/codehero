<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Course;
class CourseController extends Controller
{
   public function index()
   {
   	$data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->orderByDesc('course_cate.id_cate')->get();
   	return response()->json($data);
   }
   public function view($id)
   {
   	$data =Course::find($id);
        if (!$data) {
         return view('errors.404');
      }
        $total_star= DB::table('course')->join('rate','course.id_course','=','rate.id_course')->where('rate.id_course','=',$id)->avg('rate.star_rate');
        if ($total_star==0) {
            $total_star=5;
        }else{
            $total_star= substr($total_star, 0,3);
        }
        $id_user= session('id') or null;
        if ($id_user) {
            $rs = DB::table("accounts")->join('account_course','accounts.id','=','account_course.id_user')->where('account_course.id_course',$id)->where('accounts.id',$id_user)->get();
            if (count($rs)) {
                $lesson =DB::table('lesson')->where('course_parent',$id)->get();
                 return response()->json(['bought'=>$rs,'lessons'=>$lesson,'total_star'=>$total_star,'course_detail'=>$data,'user'=>$id_user]);
            }else{
                return response()->json(['total_star'=>$total_star,'course_detail'=>$data,'user'=>$id_user]);
            }
        }else{
            return response()->json(['total_star'=>$total_star,'course_detail'=>$data,'user'=>$id_user]);
        }
   }
}
