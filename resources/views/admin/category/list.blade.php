@extends('layouts.admin')
@section('title','Categories List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>Categories<small>List</small></h1>
	<a href="{{route('category.create')}}" class="btn btn-success">Add Category</a>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Categories</a></li>
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
								
								
							</tr>
						</thead>
						<tbody id="sortable1">
						@php($i=1)
                        @foreach($details as $detail)
                        <tr id="{{ $detail->id }}">
                        	<td>{{$i}}</td>
				            <td>{{$detail->title}}</td>
				            
				           
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
    $("#sortable1").sortable({
      stop: function(){
        $.map($(this).find('tr'), function(el) {
          var itemID = el.id;
          var itemIndex = $(el).index();
          $.ajax({
            url:"{{route('sortableCategory')}}",
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
