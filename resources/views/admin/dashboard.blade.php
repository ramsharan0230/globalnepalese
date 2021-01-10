@extends('layouts.admin')	
@section('title','Dashboard')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@section('content')
<section class="content-header">
	<h1>Dashboard<small></small></h1>
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('message') !!}
    </div>
    @endif
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

    <?php
    $post_count=count($details->get());
    $newdetails=$details->take(5)->get();
    //dd($details);
    ?>
	
</section>
<div class="content">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        
        <h3>{{$post_count}}</h3>

        <p>News</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{route('news.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-fuchsia">
      <div class="inner">
        
        <h3>{{count($users)}}</h3>

        <p>Users</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-stalker"></i>
      </div>
      <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        
        <h3>{{count($videos)}}</h3>

        <p>Video</p>
      </div>
      <div class="icon">
        <i class="ion-android-arrow-dropright-circle"></i>
      </div>
      <a href="{{route('video.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        
        <h3>{{count($teams)}}</h3>

        <p>Team</p>
      </div>
      <div class="icon">
        <i class="ion-android-contact"></i>
      </div>
      <a href="{{route('team.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Updates</h3>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Title</th>
                  <th>Date</th>
                  
                  <th>By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @php($i=1)
              @foreach($newdetails as $detail)
              <tr>
                <td>{{$i}}</td>
                <td>{{$detail->title}}</td>
                <td>{{$calendar->NEP_DATE_TIME($detail->created_at)}}</td>
                
                <td>
                  {{$detail->edited_by}}
                </td>
                <td>
                  <a class="btn btn-info edit " href="{{route('news.edit',$detail->id)}}" title="Edit">Edit</a>
                  @if(Auth::user()->role=='admin')
                  <form method= "post" action="{{route('news.destroy',$detail->id)}}" class="delete btn btn-danger">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn-delete" style="display:inline">Delete</button>
                  </form>
                  @endif
                </td>
              </tr>
              @php($i++)
              @endforeach
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
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