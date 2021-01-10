@extends('layouts.admin')	
@section('title','Setting')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@section('content')
<section class="content-header">
	<h1>Setting<small></small></h1>
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
    @if(Session::has('message'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      {!! Session::get('message') !!}
  </div>
  @endif
	
</section>
<div class="content">
<form method="post" action="{{route('setting.update',$detail->id)}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="_method" value="PUT">
  <div class="row">
      	<div class="col-md-8">
          	<div class="box box-primary">
              	<div class="box-header with-heading">
                  <h3 class="box-title">Contacts</h3>
              	</div>
              	<div class="box-body">
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" value="{{$detail->address}}">
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" class="form-control" value="{{$detail->phone}}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="{{$detail->email}}">
					</div>
					
					
					
          <!-- <div class="form-group">
            <label>Map</label>
            <textarea class="form-control" rows="3" name="map">{{$detail->map}}</textarea>
          </div> -->
          <div class="form-group">
            <label>Number of banner 1</label>
            <input type="text" name="num_banner_1" class="form-control" value="{{$detail->num_banner_1}}">
          </div>
          <div class="form-group">
            <label>Number of banner 2</label>
            <input type="text" name="num_banner_2" class="form-control" value="{{$detail->num_banner_2}}">
          </div>

					
              	</div>  
          	</div>
          	<div class="box box-warning">
          		<div class="box-header with-heading">
          			<h3 class="box-title">Seo</h3>
          		</div>
          		<div class="box-body">
          			<div class="form-group">
          				<label>Meta Title</label>
          				<input type="text" name="meta_title" class="form-control" value="{{$detail->meta_title}}">
          			</div>
          			<div class="form-group">
          				<label>Meta Description</label>
          				<textarea name="meta_description" class="form-control">{{$detail->meta_description}}</textarea>
          			</div>
          		</div>
          	</div>
      	</div>
      	<div class="col-md-4">
      		<div class="box box-warning">
      			<div class="box-header with-heading">
      				<h3 class="box-title">Image</h3>
      			</div>
      			<div class="box-body">
      				<div class="form-group">
      					<label>Logo</label>
      					<input type="file" name="logo" class="form-control">
						   @if($detail->logo)
						   <img src="{{asset('images/thumbnail/'.$detail->logo)}}" width="80px" height="80px">
						   @endif
      				</div>
      				<div class="form-group">
      					<label>Fav Icon</label>
      					<input type="file" name="fav_icon" class="form-control">
						   @if($detail->fav_icon)
						   <img src="{{asset('images/thumbnail/'.$detail->fav_icon)}}" width="80px" height="80px">
						   @endif
      				</div>
              <div class="form-group">
                <label>Footer Logo</label>
                <input type="file" name="footer_logo" class="form-control">
               @if($detail->footer_logo)
               <img src="{{asset('images/thumbnail/'.$detail->footer_logo)}}" width="80px" height="80px">
               @endif
              </div>
      			</div>
      		</div>
			
      		<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Social Network</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Facebook Link</label>
						<input type="text" name="facebook" class="form-control" value="{{$detail->facebook}}">
					</div>
					<div class="form-group">
						<label>Twitter Link</label>
						<input type="text" name="twitter" class="form-control" value="{{$detail->twitter}}">
					</div>
					<div class="form-group">
						<label>Youtube Link</label>
						<input type="text" name="youtube" class="form-control" value="{{$detail->youtube}}">
					</div>
					<div class="form-group">
						<label>Instagram Link</label>
						<input type="text" name="instagram" class="form-control" value="{{$detail->instagram}}">
					</div>
					<div class="form-group">
				    	<input type="submit" name="" value="save" class="btn btn-success">
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
  <script src="{{ asset('js/accessible_character_countdown.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <!-- datepicker -->
  <script>
  	CKEDITOR.replace('donation_detail');
    CKEDITOR.config.height = 200;
    $(document).ready(function () {
        $( "#input-field-demo" ).accessibleCharCount()
     });
  	
    </script>
@endpush