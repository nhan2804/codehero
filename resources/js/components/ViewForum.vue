<template>
	<div class="container p-0">
		<input type="hidden" id="title_web" :value="datas.title_post" name="">
		<div class="row">
			<div class="col-12">
				<div style="background:;background-position: center;background-size: cover;height: 200px;position: relative;">
					<div style="position: absolute;background: rgba(255,255,255,.4);width: 100%;padding: 2px 8px;"><b><a href="#">{{datas.name_cate}}</a></b> | <a href="#">Hoạt động</a></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
					<ul class="list_redicrect" style="display: flex;flex-wrap: wrap;">
						<li><a href="">Forum</a></li>
						<li><i class="fas fa-angle-right"></i><a href=""> {{datas.name_cate}}</a> <i class="fas fa-angle-right"></i></li>
						<li><a style="color: #333" href="#"> {{datas.title_post}}</a></li>
					</ul>
					<br>
	    	</div>
			<div class="col-lg-3 col-md-12 col-sm-12 info_post_mobile p-0">
				<div class="forum_info_auth info_user_post" style="background:;background-position: center;background-size: cover;border-radius: 50%;" ></div>
				<div class="div_level_user">
					<form method="POST" class="form_user">
					<a class="link_user" style="font-weight: 500" status="false" :username="datas.id" href="">{{datas.user}}
					<div class="user_name"></div>
					</a>
					</form>
					<div>hi</div>
					<span class="getTime hide-on-table hidden-on-pc "><i class="far fa-clock"></i> {{datas.created_at}}</span>
				</div>
			</div>
			<div class="col-lg-9 p-0">
				<div style="background: #e2ecf0;border: 5px solid #fff;box-shadow: 1px 2px 3px gray;border-radius: 16px;padding: 4px 8px">
					<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
						<span class="getTime">{{datas.created_at}}</span>
						<span class="getTime hide-on-mobile">{{datas.created_at}}</span>
					</div>
					<div class="cmt_forum">
						<h3 style="text-transform: uppercase;">{{datas.title_post}}</h3>
						<hr>
						<div v-html="datas.content_post" class="content_post">
						</div>
					</div>
					<div>
						<br>
						<form onsubmit="return false" action="post">
							<button v-if="user_react" :data-id="datas.id_post" style="line-height: 1;width: 100px" class="btn btn-primary btn-sm btn_react"><i style="color: red" class="fas fa-heart"></i> Đã thích</button>
							<button v-else :data-id="datas.id_post" style="line-height: 1;width: 100px" class="btn btn-info btn-sm btn_react">Thích</button>
						<span v-html="allreact"></span>
						</form>
					</div>
					<div class="socials-share" style="display: flex;justify-content: flex-end;margin: 0">
			    	<a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><i class="fab fa-facebook-f"></i> Share</a>
					</div>
				</div>
			</div>
		</div>
</div>
</template>

<script>
export default {

  name: 'ViewForum',

  data () {
    return {
    	id:this.$route.params.id,
    	user_react:false,
    	datas:{},
    	cmt_parent:[],
    	cmt_child:[],
    	allreact:0
    }
  },
  mounted(){
  	this.loadViewForum();
  },
  methods:{
  	loadViewForum:function() {
		axios.get('http://localhost/codehero/api/forum/'+this.id+'/slug')
		.then((rep)=>{
			this.datas= rep.data.datas;
			this.cmt_parent= rep.data.allcmt;
			this.cmt_child= rep.data.cmt_child;
			this.user_react= rep.data.user_react;
			this.allreact = rep.data.allreact;
			console.log('test');
			console.log(rep.data.datas);
		})
		.catch((e)=>{
			console.log(e);
		})
    	}
  }
}
</script>

<style lang="css" scoped>
</style>