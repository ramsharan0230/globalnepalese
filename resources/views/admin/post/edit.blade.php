@extends('layouts.admin')	
@section('title','Edit News')
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
	<h1>News<small>edit</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">News</a></li>
		<li><a href="">Edit</a></li>
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
<form method="post" action="{{route('news.update',$detail->id)}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" name="_method" value="PUT">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Edit news</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title(required)</label>
						<input type="text" name="title" class="form-control" value="{{$detail->title}}">
					</div>
					<div class="form-group">
                		<label>Select Categories</label>
                  		<select multiple="" class="js-example-basic-multiple form-control" name="category[]">
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
                			<option value="{{$tag->id}}" {{$detail->tag_id==$tag->id?'selected':''}}>{{$tag->title}}</option>
                  		@endforeach
                  		</select>
                	</div>
                	<!-- <div class="form-group">
						<label>Video Link(required)</label>
						<input type="text" name="link" value="{{$detail->link}}" class="form-control">
					</div> -->
					<div class="form-group">
						<label>Reporter</label>
						<input type="text" name="reporter" value="{{$detail->reporter}}" class="form-control">
					</div>
					<div class="form-group">
						<label>Short Description</label>
						<textarea name="short_description" class="form-control">{{$detail->short_description}}</textarea>
					</div>
					<div class="form-group">
						<label>Description(required)</label>
						<textarea class="form-control" name="description" rows="3">{{html_entity_decode($detail->description)}}</textarea>
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
					   <input type="text" name="meta_title" class="form-control" value="{{$detail->meta_title}}">
					</div>
					<div class="form-group">
					   <label>Meta Description(required)</label>
					   <textarea class="form-control" name="meta_description" rows="3">{{$detail->meta_description}}</textarea>
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
					   @if($detail->image)
					   <div class="form-group image">
					   		<strong>Thumbnail Image</strong>
					   		<br>
					   		<img src="{{ asset('images/listing/'.$detail->image) }}" />
					   		<div class="btn btn-danger removeImage" data-id="{{$detail->id}}" data-type="mainimage">X</div>
					   </div>
					   @endif

					</div>
					<div class="form-group">
					   <label>reporter Image(less than 250*250)</label>
					   <input type="file" name="reporter_image" class="form-control">
					   @if($detail->reporter_image)
					   <div class="form-group reporterimage ">
					   		<strong>Thumbnail Image</strong>
					   		<br>
					   		<img src="{{ asset('images/reporter/'.$detail->reporter_image) }}" />
					   		<div class="btn btn-danger removeImage" data-id="{{$detail->id}}" data-type="reporter">X</div>
					   </div>
					   @endif
					</div>
					<!-- <div class="form-group">
						<label>Reporter Fb</label>
						<input type="text" name="reporter_fb" class="form-control" value="{{$detail->reporter_fb}}">
					</div>
					<div class="form-group">
						<label>Reporter Twitter</label>
						<input type="text" name="reporter_twitter" class="form-control" value="{{$detail->reporter_twitter}}">
					</div> -->
					<!-- <div class="form-group">
						<label>Image Link</label>
						<input type="text" name="image_link" value="{{$detail->image_link}}" class="form-control">
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
							<input autocomplete="off" type="text" id="datetimepicker" name="dateandtime" class="form-control"
								value="{{ $detail->dateandtime }}">
					</div>
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" {{$detail->publish==1?'checked':''}}> Publish</label>
				    </div>
					
				    <div class="form-group">
						<label for="banner1"><input type="checkbox" id="banner1" name="banner1" {{$detail->banner1==1?'checked':''}}> Banner1</label>
				    </div>
				    <div class="form-group">
						<label for="banner2"><input type="checkbox" id="banner2" name="banner2" {{$detail->banner2==1?'checked':''}}> Banner2</label>
				    </div>
				    
				    <!-- <div class="form-group">
						<label for="main_news"><input type="checkbox" id="main_news" name="main_news" {{$detail->main_news==1?'checked':''}}> Main News</label>
				    </div> -->
				   <!--  <div class="form-group">
						<label for="feature"><input type="checkbox" id="feature" name="feature" {{$detail->feature==1?'checked':''}}> Feature</label>
				    </div> -->
				    <div class="form-group">
				    	<button type="submit" class="btn btn-info"> publish</button>
				    	<!-- <input type="submit" name="" class="btn btn-success"> -->
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
  <!-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> -->
  <!-- <script src="//cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script> -->
 {{-- <script src="//cdn.ckeditor.com/4.11.3/full/ckeditor.js"></script> --}}
<!-- Standard -->
 {{-- <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script> --}}
 <!--Full-->
 <script src="{{ asset('backend/bootstrap/ckeditor/ckeditor.js') }}"></script> 
 
  <script src="{{asset('backend/bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>

  <!-- datepicker -->
  <script>
  	$.ajaxSetup({
  	    headers: {
  	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  	    }
  	});
  	$(".js-example-basic-multiple").select2().val({!! json_encode($detail->Categories()->pluck('category_id')) !!}).trigger('change');
  	var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
    CKEDITOR.replace('description', options);
  	CKEDITOR.config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Font,Styles,Format,Maximize,ShowBlocks,About';


  	
  	$('.message').delay(5000).fadeOut(400);
  	$(".js-example-basic-multiple").select2();

  	
  	$(document).ready(function(){
  		$('.removeImage').click(function(e){
  			e.preventDefault();
  			id=$(this).data('id');

  			var message=confirm('Are you sure to delete');
  			if(message){
          		$.ajax({
          			method:'post',
          			url:"{{route('removeImage')}}",
          			data:{id:id},
          			success:function(data){
          				if(data=='success'){
          					$('.image').remove();
          				}else{
          					$('.reporterimage').remove();
          				}
          				
          			}
          		});
        	}
  			
  		});
  	});
  	$(document).ready(function(){
        $("#datetimepicker").datetimepicker();
    });
    </script>
@endpush