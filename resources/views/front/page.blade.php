@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<section class="innerPage">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-9">
            <div class="innerPage__content">
               <h3> {{$page->title}} </h3>
               <br>
               <p>
                 {!!$page->description!!}
               </p>
              
            </div>
         </div>
      </div>

   </div>
</section>
@endsection