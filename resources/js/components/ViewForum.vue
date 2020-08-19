<template>
	<div>
		<div class="modal_popup_cmt hidden">
        <div class="layer"></div>
        <div class="popup_edit">
           <form class="form_edit">
           	<div class="heading_edit">
           		<h3>Chỉnh sửa bình luận</h3>
           		<i class="fas fa-times"></i>
           	</div>
           	<div class="text_edit">
           		<input v-model="cmt.content" type="text" name="">
           	</div>
           	<div style="display: flex;justify-content: flex-end;padding: 4px;">
           		<input class="btn btn-success text-right" type="submit" value="Sửa" name="">
           	</div>
           </form>
        </div>
    </div>
    <br>
    <br>
    <br>
	<div class="container p-0">
		<input type="hidden" id="title_web" :value="datas.title_post" name="">
		<div class="row">
			<div class="col-12">
				<div :style="{backgroundImage:'url(./'+datas.img_cate+')'}" style="background:;background-position: center;background-size: cover;height: 200px;position: relative;">
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
				<div class="forum_info_auth info_user_post" :style="{backgroundImage:'url(./'+datas.avatar+')'}"  style=";background-position: center;background-size: cover;border-radius: 50%;" ></div>
				<div class="div_level_user">
					<form method="POST" class="form_user">
					<a class="link_user" style="font-weight: 500" status="false" :username="datas.id" href="">{{datas.displayname}}
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
		<br>
		<div>Sắp xếp theo :</div>
		<button v-on:click="asc">Mới nhất</button>
		<button v-on:click="desc">Cũ nhất</button>
		<Comment v-for="(value,i) in reply"
				v-bind:cmt="value" :key="i"
				v-bind:reply="value.reply"
				v-on:deleteCmt="deleteCmt"
				v-on:editCmt="editCmt"
				v-bind:user="user"
				v-bind:idPost="datas.id_post"
				v-on:replyCmt="replyCmt"
				>	
		</Comment>
		<br>
		<form v-if="user" onsubmit="return false">
			<div class="comment">
				<div class="info_cmt">
					<img class="img_cmt" style="width:70px;height:70px" :src="'./'+user.avatar" alt="">
					<h3 class="name_auth">{{user.user}}</h3>
				</div>
				<input v-model="cmt.content" class="input_cmt" placeholder="Nhập để bình luận" name="cmt" id="cmt_input"/>
			</div>
			<div class="btn_cmt">
				<input class="btn btn-primary" :data-auth="datas.id" :data-id="datas.id_post" id="cmt_forum" type="submit" v-on:click="addCmt" value="Bình luận">
			</div>
		</form>
		<h3 v-else class="left_cmt">Đăng nhập để bình luận</h3>
	</div>
</div>
</template>
<script>
import Comment from './CommentComponent';

export default {

  name: 'ViewForum',
  components:{
  	Comment
  },
  data () {
    return {
    	elem:8,
    	turn:4,
    	width:1,
    	load:true,
    	cmt:{},
    	user:{},
    	id:this.$route.params.id,
    	user_react:false,
    	datas:{},
    	cmt_parent:[],
    	cmt_child:[],
    	allreact:0,
    	allcmt:[]
    }
  },
  computed:{
  	reply(){
  		return this.cmt_parent.map((v,i)=>{
  			v.reply=[];
  			this.cmt_child.map((v1,i1)=> {
  				if(v.id_cmt==v1.id_parent){
  					v.reply.push(v1);
  				}else{
  				}
  			})
  			return v;
  		})
  	}
  },
  mounted(){
  	this.loadViewForum();
  	this.process();
  	
  	
  },
  updated(){
  	this.cmt.id_post=this.datas.id_post;
  },
  methods:{
  	loadViewForum:function() {
		axios.get('http://localhost/codehero/api/forum/'+this.id+'/slug')
		.then((rep)=> {
			this.datas= rep.data.datas;
			this.cmt_parent= rep.data.allcmt.data;
			
			this.cmt_child= rep.data.cmt_child;
			this.user_react= rep.data.user_react;
			this.allreact = rep.data.allreact;
			this.user = rep.data.user;
			
		})
		.catch((e)=>{
			console.log(e);
		})
    },
    deleteCmt(id){
    	this.cmt_parent.splice(0, 1);
    },
    editCmt(id){
    	this.cmt.content= id.content;
    	var index=getIndex(id.id);
    	this.cmt_parent[index].content=cmt.content;
    },
    getIndex(id){
    	this.cmt_parent.forEach((el,i)=>{
    		if(el.id_cmt==id){
    			return i;
    		}
    	});
    },
    addCmt(){
    	axios.post('http://localhost/codehero/api/forum/add', {
		  content: this.cmt.content,
		  id_post: this.cmt.id_post
		})
		.then((rep)=>{
		  this.cmt_parent.push(rep.data);
		})
		.catch((e)=> {
		  console.log(e);
		});
    },
    replyCmt(data){
    	axios.post('http://localhost/codehero/api/forum/reply', {
		  content:data.content,
		  id_post: this.datas.id_post,
		  id_cmt: data.id_cmt
		})
		.then((rep)=>{
		  this.cmt_child.push(rep.data);
		})
		.catch((e)=> {
		  console.log(e);
		});
    },
    asc(){
    	this.cmt_parent.reverse();
    },
    desc(){
    	this.cmt_parent.reverse();
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