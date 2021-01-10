@extends('layouts.admin')
@section('title','Add video')
@section('content')
<section class="content-header">
	<h1>Video<small>add</small></h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Video</a></li>
		<li><a href="">add</a></li>
	</ol>
</section>
<div class="content">
	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
<form method="post" action="{{route('video.store')}}" >
	{{csrf_field()}}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Add a new video</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" value="{{old('title')}}">
					</div>
					<div class="form-group">
						<label>Link(required)</label>
						<input type="text" name="link" value="{{old('link')}}" class="form-control">
					</div>
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" checked>Publish</label>
						
				    </div>
					<div class="form-group">
						<input type="submit" name="" class="btn btn-success">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
@endsection
@push('script')
  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
 
@endpush