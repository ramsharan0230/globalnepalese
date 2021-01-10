@extends('layouts.admin')	
@section('title','Add News')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">

<!-- bootstrap wysihtml5 - text editor -->
@endpush

@push('styles')
<link rel="stylesheet" href="{{asset('backend/bootstrap/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@section('content')
<section class="content-header">
	<h1>News<small>create</small></h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">News</a></li>
		<li><a href="">Create</a></li>
	</ol>
</section>
<div class="content">
	@if (count($errors) > 0)
	<div class="alert alert-danger message">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
<form method="post" action="{{route('news.store')}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Add a news</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title(required)</label>
						<input type="text" name="title" class="form-control" value="{{old('title')}}">
					</div>
					<div class="form-group">
                		<label>Select Categories</label>
                		<select multiple="multiple" class="js-example-basic-multiple form-control" name="category[]">
                  		@foreach($categories as $category)
                			<option value="{{$category->id}}">{{$category->title}}</option>
                  		@endforeach
                  		</select>
                	</div>
                	<div class="form-group">
                		<label>Select Tags</label>
                		<select class="form-control"  name="tag_id">
                		   <option value>Please select tag</option>
                  		@foreach($tags as $tag)
                			<option value="{{$tag->id}}">{{$tag->title}}</option>
                  		@endforeach
                  		</select>
                	</div>
                	<!-- <div class="form-group">
						<label>Video Link</label>
						<input type="text" name="link" value="{{old('link')}}" class="form-control">
					</div> -->
					<div class="form-group">
						<label>Reporter</label>
						<input type="text" name="reporter" value="{{old('reporter')}}" class="form-control">
					</div>
					<div class="form-group">
						<label>Short Description</label>
						<textarea name="short_description" class="form-control">{{old('short_description')}}</textarea>
					</div>
					<div class="form-group">
						<label>Description(required)</label>
						<textarea id="my-editor" name="description" class="form-control">{{old('description')}}</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<!-- <div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">SEO</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
					   <label>Meta Title(required)</label>
					   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title')}}">
					</div>
					<div class="form-group">
					   <label>Meta Description(required)</label>
					   <textarea class="form-control" name="meta_description" rows="3">{{old('meta_description')}}</textarea>
					</div>
				</div>
			</div> -->
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Image</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
					   <label>Upload Image</label>
					   <input type="file" name="image" class="form-control">
					</div>
					<div class="form-group">
					   <label>reporter Image(less than 250*250)</label>
					   <input type="file" name="reporter_image" class="form-control">
					</div>
					{{--
					<div class="form-group">
						<label>Reporter Fb</label>
						<input type="text" name="reporter_fb" class="form-control">
					</div>
					<div class="form-group">
						<label>Reporter Twitter</label>
						<input type="text" name="reporter_twitter" class="form-control">
					</div>
					--}}
					<!-- <div class="form-group">
						<label>Image Link</label>
						<input type="text" name="image_link" value="{{old('image_link')}}" class="form-control">
					</div> -->
				</div>
			</div>
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Publish</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
							<label for="">Date and Time for publish</label>
							<input autocomplete="off" type="text" id="datetimepicker" name="dateandtime" class="form-control">
					</div> 		
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" checked> Publish</label>
				    </div>
				    <div class="form-group">
						<label for="banner1"><input type="checkbox"  name="banner1" id="banner"> Banner1</label>
				    </div>
				    <div class="form-group">
						<label for="banner2"><input type="checkbox"  name="banner2" id="banner"> Banner2</label>
				    </div>
				    
				    <!-- <div class="form-group">
						<label for="main_news"><input type="checkbox"  name="main_news" id="main_news"> Main News</label>
				    </div> -->
				    <!-- <div class="form-group">
						<label for="feature"><input type="checkbox"  name="feature" id="feature"> Feature</label>
				    </div> -->
				    <div class="form-group">
				    	<button type="submit" class="btn btn-info"> publish</button>
				    	<!-- <input type="submit" name="publish" class="btn btn-success"> -->
				    </div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  {{-- <script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script> --}}
  <!-- Standard -->
 {{-- <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script> --}}
 <!--Full-->
 <script src="{{ asset('backend/bootstrap/ckeditor/ckeditor.js') }}"></script> 
 
  <script src="{{asset('backend/bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>

  <!-- datepicker -->
  <script>
  	var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  	
    CKEDITOR.replace('my-editor', options);
    CKEDITOR.config.height = 200;
    CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
    CKEDITOR.config.colorButton_enableMore = true;
    CKEDITOR.config.floatpanel = true;
    




  
  	

  
  	$('.message').delay(5000).fadeOut(400);
  	$(".js-example-basic-multiple").select2();
  	$(document).ready(function(){
        $("#datetimepicker").datetimepicker();
    });
    </script>
@endpush