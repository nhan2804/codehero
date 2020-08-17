<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class ForumController extends Controller
{
    public function index()
    {
    	$data = DB::table('forum')->selectRaw('COUNT(react.id_post) as react,COUNT(cmt.id_forum) as cmt,user, name_cate,img_cate,title_post,forum.created_at,avatar,color_cate,forum.id_post,slug_forum,like_post,comments,views,accounts.id')->Join('forum_cate','forum.id_cate_forum','=','forum_cate.id_cate')->Join('accounts','forum.auth_post','=','accounts.id')
            ->leftJoin('react', 'forum.id_post', '=', 'react.id_post')
            ->leftJoin('cmt', 'forum.id_post', '=', 'cmt.id_forum')
            ->groupBy('forum.id_post')
            ->orderBy('forum.created_at','DESC')->paginate(10);


            $data_new = DB::table('forum')->selectRaw('COUNT(react.id_post) as react,COUNT(cmt.id_forum) as cmt,user, name_cate,img_cate,title_post,forum.created_at,avatar,color_cate,forum.id_post,slug_forum,like_post,comments,views,accounts.id')->Join('forum_cate','forum.id_cate_forum','=','forum_cate.id_cate')->Join('accounts','forum.auth_post','=','accounts.id')
            ->leftJoin('react', 'forum.id_post', '=', 'react.id_post')
            ->leftJoin('cmt', 'forum.id_post', '=', 'cmt.id_forum')
            ->groupBy('forum.id_post')
            ->orderBy('forum.comments','DESC')->whereDate('forum.created_at', Carbon::today())->skip(0)->take(5)->get();;
		      $cate_forum= DB::table('forum_cate')->join('forum','forum_cate.id_cate','=','forum.id_cate_forum')
		                  ->select('id_post','name_cate','id_cate','title_post',DB::raw('COUNT(forum.id_cate_forum) as sum_post,max(forum.id_post) as MAXimum'))->distinct()
		                  ->whereRaw('id_post','max(forum.id_post)')
		                   ->groupBy('forum.id_cate_forum')
		                   ->get();
		   	$arr = [ 
		   		'data' => $data,
		        'cate_forum'=>$cate_forum,
		        'data_new'=>$data_new,
		        'user'=> Session::get('id')
		   	];
         return response()->json($arr);
    }
}
