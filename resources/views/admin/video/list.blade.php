@extends('layouts.admin')
@section('title','Video List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
  <h1>Video<small>List</small></h1>
    <a href="{{route('video.create')}}" class="btn btn-success">Add Video</a>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li><a href="">Video</a></li>
      <li><a href="">List</a></li>
    </ol>
</section>
<div class="content">
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible message">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('message') !!}
    </div>
    @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">Video List</h3>
            </div>
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Title</th>
                      <th>Video</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                @php($i=1)
                @foreach($details as $detail)
                  <tr id="{{ $detail->id }}">
                      <td>{{$i}}</td>
                      <td>{{$detail->title}}</td>
                      <td><iframe width="200" height="100" src="https://www.youtube.com/embed/{{$detail->youtubeVideo($detail->link)}}" frameborder="3" gesture="media" allow="encrypted-media" allowfullscreen></iframe></td>
                      <td>{{$detail->publish==1? 'active':'inactive'}}</td>
                      <td>
                        <a class="btn btn-info edit" href="{{route('video.edit',$detail->id)}}" title="Edit">Edit</a>
                        <form method= "post" action="{{route('video.destroy',$detail->id)}}" class="delete btn btn-danger">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-delete" style="display:inline">Delete</button>
                        </form>
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
  <!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('backend/plugins/fastclick/fastclick.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script >
    $(document).ready(function(){
       $('.delete').submit(function(e){
        e.preventDefault();
        var message=confirm('Are you sure to delete?');
        if(message){
          this.submit();
        }
        return;
       });
    });
  </script>
  <script>
  $(function () {
    $("#example1").DataTable();
  });
  $('.message').delay(5000).fadeOut(400);
</script>
@endpush
