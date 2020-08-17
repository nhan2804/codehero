<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Blog;
use App\Admin;
class ProfileController extends Controller
{
    public function index()
    {
        $id_user = session('id');
       $data = Admin::find($id_user);
       return view('page.info_user.info',compact('data',$data));
    }
    public function course()
    {
    	$id_user = session('id');
    	$rs = DB::table("accounts")->select('course.*')->join('account_course','accounts.id','=','account_course.id_user')->join('course','account_course.id_course','=','course.id_course')->where('accounts.id',$id_user)->get();
    	return view('page.info_user.courses',compact('rs',$rs));
    }
    public function logout(Request $req)
    {
        $req->session()->flush();
        return back();
    }
    public function post(Request $req)
    {
        $id_user = session('id');
       $data = Blog::where('auth',$id_user)->paginate(10);
       return view('page.info_user.post',compact('data',$data));
    }
}
