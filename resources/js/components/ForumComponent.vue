<template>
<div class="container p-0">
	<br>
	<br>
	<br>
	<div v-if="user!=null" style="display: flex;justify-content: center;">
		<a href="blog/create-forum" style="border: 2px solid #007bff" class="btn "><i class="fas fa-plus"></i> Thảo luận</a>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div style="border-radius: unset;outline: none;width: 200px" class=" btn btn-primary"><i class="far fa-newspaper"></i> Mới nhất</div>
				</div>
				<template v-if="load">
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				</template>
				<div v-for="value in covertTitle" class="col-lg-12">
					<div class="item_forum" style="display: flex;padding: 10px 0;margin:10px 0;border-top-left-radius: 20px;border-bottom-right-radius: 20px">
						<div :style="{backgroundImage:'url(./'+value.avatar+')'}" style=";background-position: center;background-size: cover;width: 80px;height: 80px;border-radius: 50%;margin-left: 8px"></div>
						<div style="height: 80px;flex: 1;margin-left: 8px;position: relative;">
							<div style="display: flex;font-size: .8rem;">
								<span v-bind:style="{backgroundColor:value.color_cate}" style="display: block;padding: 0 4px;border-radius: 10px;color: white">{{value.name_cate}}</span>
								<span style="margin-left: 8px">{{value.created_at}}</span>
							</div>
							<router-link tag="a" class="link_forum" style="display: block;font-size: 1.1rem;" :to="{ path: '/forum/' + value.id_post+'/'+value.slug_forum+'.xml'}">{{value.title_post}}</router-link>
							<div style="align-items: flex-end;position: absolute;bottom: 0">
								<span style="font-size: 0.8rem"><i  class="fas fa-heart icon_heart"></i>{{value.react}}</span>
								<span><i style="font-size: 0.8rem" class="far fa-comment-dots"> {{value.cmt}}</i></span>
								<span><i style="font-size: 0.8rem" class="far fa-eye"> {{value.views}}</i></span>
								<i style="font-size: 0.8rem" class="fas fa-user"></i><a class="link_user" username="" status="false" href="#">{{value.user}}<div class="user_name"></div></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div>
				<!-- {{$data->links()}} -->
			</div>
		</div>
		<div class="col-lg-4">
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;background: #574BFC" class="heading-new btn btn-primary">Top thảo luận</div>
			</div>
			<br>
				<div v-for="value in new_data" class="p-0">
					<div class="item_forum" style="display: flex;padding: 10px 0;margin:10px 0;border-top-left-radius: 20px;border-bottom-right-radius: 20px">
						<div :style="{backgroundImage:'url(./'+value.avatar+')'}" style="background-position: center;background-size: cover;width: 80px;height: 80px;border-radius: 50%;margin-left: 4px"></div>
						<div style="height: 80px;flex: 1;margin-left: 8px;position: relative;">
							<div style="display: flex;font-size: .8rem;">
								<span :style="{backgroundColor:value.color_cate}" style="display: block;padding: 0 4px;border-radius: 10px;color: white">{{value.name_cate}}</span>
								<span style="margin-left: 8px">{{value.created_at}}</span>
							</div>
							<router-link tag="a" class="link_forum" style="display: block;font-size: 1.1rem;" :to="{ path: '/forum/' + value.id_post+'/'+value.slug_forum+'.xml'}">{{value.title_post}}</router-link>
							<div style="align-items: flex-end;position: absolute;bottom: 0">
								<span style="font-size: 0.8rem"><i  class="fas fa-heart icon_heart"></i>{{value.react}}</span>
								<span><i style="font-size: 0.8rem" class="far fa-comment-dots"> {{value.cmt}}</i></span>
								<span><i style="font-size: 0.8rem" class="far fa-eye"> {{value.views}}</i></span>
								<i style="font-size: 0.8rem" class="fas fa-user"></i><a class="link_user" username="" status="false" href="#">{{value.user}}<div class="user_name"></div></a>
							</div>
						</div>
					</div>
				</div>
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;" class="heading-new btn btn-danger">Chủ đề</div>
			</div>
			<br>
			<ul class="list__cate--forum">
				<template>
					<li class="item__cate--forum"></li>
				</template>
				<li v-for="value in cate_data" class="item__cate--forum">
					<router-link tag="a" class="link_forum" style="display: block;font-size: 1.1rem;" :to="{ path: '/forum/thread/'+value.id_cate}">{{value.name_cate}}</router-link>
					<span>Tổng bài viết :{{value.sum_post}} </span>
					<span>Mới nhất :{{value.title_post}} </span>
				</li>
			</ul>
			
		</div>
	</div>
</div>
</template>

<script>
export default {
  name: 'ForumComponent',
  data () {
    return {
    	elem:8,
    	turn:4,
    	width:1,
    	user:1,
    	datas:[],
    	cate_data:[],
    	new_data:[],
    	load:true
    }
  },
  mounted(){
    	this.loadForum(); 
    	this.process();	
  },
  updated(){

		$('.item_forum').each(function(i, el) {
	       if (i % 2 === 0) {

	        $(this).addClass('blue_light');
	       }else{
	        $(this).addClass('gray_light');
	       }
		});
		this.load=false;
  },
  computed:{
  	covertTitle(){
  		return this.datas.map((el,index)=> {
  			if(el.title_post.length>80){
  				el.title_post=el.title_post.slice(0,80)+'...';
  				return el;
  			}else{
  				return el;
  			}
  		})
  	}

  },
  methods:{
    	loadForum:function() {
    		axios.get('http://localhost/codehero/api/forum')
    		.then((rep)=>{
    			this.datas=rep.data.data.data;
    			this.cate_data=rep.data.cate_forum;
    			this.new_data=rep.data.data_new;

    			this.user=rep.data.user;
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	},
    	process:function() {
		    this.elem = document.getElementById("progress_bar");
		    this.turn = setInterval(this.frame, 10);
		  },
		frame:function(){
	    	if(this.width>= 100) {
	        clearInterval(this.turn);
	        this.elem.style.width = 0 + "%";
	      	}else {
		      	if(this.width>=60 && this.load){
		      		this.width+=1;
		      	}else if(!this.load){
		      		this.width+=10;
		      	}else{
		      		this.width+=3;
		      	}
	        this.elem.style.width = this.width + "%"; 
	      }
		}
    }
}

</script>
<style lang="css" scoped>
</style>