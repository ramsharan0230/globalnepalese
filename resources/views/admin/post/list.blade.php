@extends('layouts.admin')
@section('title','News List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>News<small>List</small></h1>
	<a href="{{route('news.create')}}" class="btn btn-success">Add News</a>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">News</a></li>
		<li><a href="">list</a></li>
	</ol>
</section>
<div class="content">
	@if(Session::has('message'))
	<div class="alert alert-success alert-dismissible">
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
					<h3 class="box-title">Data Table</h3>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.N.</th>
								<th>Title</th>
								<th>Image</th>
								
								<th>Category</th>
								<th>Date</th>
								<th>Views</th>
								<th>Status</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody id="sortable">
						@php($i=1)
                        @foreach($details as $detail)
                        <tr id="{{$detail->id}}">
                        	<td>{{$i}}</td>
				            <td>{{$detail->title}}</td>
				            <td>@if($detail->image)
								<img src="{{asset('images/listing/'.$detail->image)}}">
								@else
								<p>N/A</p>
								@endif
				            </td>
				            
				            <td><ul>
				            	@foreach($detail->categories as $category)
				            	<li>{{$category->title}}</li>
				            	@endforeach
				            	</ul>
				            </td>
				            <td>{{$calendar->NEP_DATE_TIME($detail->created_at)}}</td>
				            <td>{{$detail->view}}</td>
				            <td>
				            	
				            	{{$detail->publish==1?'active':'inactive'}}
				            	
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
  <!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('backend/plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{asset('backend/plugins/jQueryUI/jquery-ui.js')}}"></script>
  <script >
  	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
       $('.delete').submit(function(e){
        e.preventDefault();
        var message=confirm('Are you sure to delete');
        if(message){
          this.submit();
        }
        return;
       });
    });

    $(document).ready(function(){
	    $(document).on('click','.change-status',function(){
	      	var _this = this;
	      	var status=$(_this).data('val');
	       	var id=$(_this).parent().data('fid');
	      	$.ajax({
	        	method: "POST",
	        	url:"{{route('changeStatus')}}",
	        	data: {status:status,id:id},
	        	success:function(res){
	          		console.log(res);
	          		$(_this).addClass('active');
	          		$(_this).siblings().removeClass('active');
	        }
	    });
    });
    });

    $("#sortable").sortable({
      stop: function(){
        $.map($(this).find('tr'), function(el) {
          var itemID = el.id;
          var itemIndex = $(el).index();
          $.ajax({
            url:"{{route('postChangeOrder')}}",
            method:"post",
             data: {itemID:itemID, itemIndex: itemIndex},
            success:function(data){
              console.log(data);
            }
          })
        });
      }
    });


  </script>
  <script>
  $(function () {
    $("#example1").DataTable();
  });
  $('#example1').dataTable( {
  "pageLength": 500
	} );

</script>
@endpush
