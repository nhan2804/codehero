<template>
	<div class="mb-3">
		<div class="row">
			<div class="col-lg-2 col-md-12 col-sm-12 p-0">
				<div class="div_info_post info_post_mobile">
					<div class="forum_info_auth info_user_cmt" :style="{backgroundImage:'url(./'+cmt.avatar+')'}" style="background-position: center;background-size: cover;border-radius: 50%" ></div>
					<div class="div_level_user">
						<a class="link_user" style="font-weight: 500;margin-right: 4px" status="false" :username="cmt.id" href="">{{cmt.displayname}}
						<div class="user_name"></div>
						</a>
					</div>
				</div>
			</div>
			<div :id="'comment_' + cmt.id_cmt" style="background: #e2ecf0;box-shadow: 1px 2px 3px #ccc;border-radius: 4px;background: #F6EDD2" class="col-lg-10 alert-info p-2">
				<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
					#{{cmt.id_cmt}} | <span class="getTime">{{cmt.created_at}}</span>
				</div>
				<div v-html="cmt.content_cmt" :id="'cmt_forum_'+cmt.id_cmt" class="cmt_forum">
				</div>
				<div>
					<br>
					<button style="line-height: 1;width: 80px" class="btn btn-info btn-sm">Like!</button> 
				</div>
				<div style="display: flex;justify-content: flex-end;">
					<!-- @if(Session::get('id')==cmt->id_auth || Session::get('id')==$data->id)
					<i title="Xóa" style="margin: 0 8px" data-id="{{cmt->id_cmt}}" class="far fa-trash-alt del_cmt"></i>
					<i title="Sửa" style="margin: 0 8px" data-id="{{cmt->id_cmt}}" class="fas fa-edit edit_cmt"></i>
					@endif -->
					<i title="Sửa" style="margin: 0 8px" v-on:click="editCmt" class="fas fa-edit edit_cmt"></i>
					<i title="Xóa" style="margin: 0 8px" v-on:click="deleteCmt" class="far fa-trash-alt del_cmt"></i>
					<!-- <i title="Báo cáo" class="fas fa-exclamation-triangle"></i>
					<i data-id-0="{{cmt->id_cmt}}" title="Trả lời" data-id="{{cmt->id_cmt}}" data-name="{{cmt->user}}" style="margin: 0 8px" class="fas fa-reply btn_reply"></i> -->
				</div>
			</div>
		</div>
		<Reply
			v-for="(v,j) in reply"
			v-bind:reply="v" :key="j">
		</Reply>
		<br>
		<div style="padding-left: 100px">
			<form v-if="user" id="'form_reply_'+cmt.id_cmt" class="" onsubmit="return false">
				<div class="comment">
					<div class="info_cmt">
						<img class="img_cmt" :src="'./'+user.avatar" alt="">
						<h3 class="name_auth">{{user.displayname}}</h3>
					</div>
					<span :id="'tag_name_'+cmt.id_cmt" class="tag_name"></span>
					<input style="padding-left: 70px;"  class="input_cmt" :id="'reply_cmt_'+cmt.id_cmt" placeholder="Nhập để trả lời bình luận" name="cmt" v-model="rep.content" >
				</div>
				<div class="btn_cmt">
					<input class="btn btn-primary btn_reply_cmt " :data-cmt="cmt.id_cmt" :data-auth="user.id" :data-id="idPost" type="submit" link="comment_" v-on:click="replyCmt" value="Bình luận">
				</div>
			</form>
		</div>
	</div>
</template>

<script>
import Reply from './ReplyComponent';
export default {
  name: 'CommentComponent',
  data () {
    return {
    	rep:{}
    }
  },
  components:{
  	Reply
  },
  props:{
  	cmt: Object,
  	user: Object,
  	idPost:Number,
  	reply:Array
  },
  methods:{
  	deleteCmt(){
  		this.$emit('deleteCmt',{id:this.cmt.id_cmt});
  	},
  	editCmt(){
  		this.$emit('editCmt',{content:this.cmt.content_cmt,id:this.cmt.id_cmt});
  	},
  	replyCmt(){
  		this.$emit('replyCmt',{id_cmt:this.cmt.id_cmt,content:this.rep.content});
  	}
  }
}
</script>

<style lang="css" scoped>
</style>