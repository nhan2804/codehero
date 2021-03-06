@extends('admin_home')
@section('admin_content')
<br>
<div class="alert alert-secondary hidden">
	<?php
	if (Session::get('success_up')) {
		echo Session::get('success_up');
	}
	?>
</div>
<h3>Tạo thể loại</h3>
<div class="row">
	<div class="col-lg-12">
		<form method="POST" action="{{URL::to('admin/document/insert-cate-docs')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<label>Tên loại</label>
				<input type="text"  name="name_cate" class="form-control">
			</div>
			<input class="btn-success btn" type="submit" name="create_cate" value="Tạo">
		</form>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
		<br><br>
			<table class="table table-striped">
				<tr>
					<td>STT</td>
					<td>Tên</td>
					<td>Tùy chọn</td>
				</tr>
				@foreach($cate_doc as $k=>$v)
				<tr>
					<td>{{$v->id_cate}}</td>
					<td>{{$v->name_cate}}</td>
					<td>
						<a href="#">Sửa <i class="far fa-edit"></i></a>
						<a href="#">Xóa <i class="far fa-trash-alt"></i></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<br>
<hr>
<h3>Đăng tài liệu</h3>
<form action="{{URL::to('admin/document/insert-docs')}}" action="{{URL::to('admin/blog/insert-blog')}}" class="dropzone" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <!-- ... -->
  <div class="form-group">
	<label>Tên tài liệu</label>
	<input class="form-control" type="text" name="name_doc"><br>
	<label>Nội dung bài viết</label>

	<textarea class="form-control" name="content_doc" cols="80" rows="10"></textarea>
  </div>
  <div class="form-group">
  	<select class="" name="id_cate">
  		@foreach($cate_doc as $k=>$v)
  			<option value="{{$v->id_cate}}">{{$v->name_cate}}</option>
  		@endforeach
  	</select>
  </div>
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>
<br><br>
@endsection