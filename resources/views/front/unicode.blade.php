@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<section class="detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-12">
                <div class="detail-page-wrapper">
                    <iframe src="https://www.ashesh.com.np/unicode-preeti/linkapi.php?api=512180i323" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:745px; height:400px;" allowtransparency="true">
                    </iframe>
                    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-unicode3.php?api=170154j117">
                    </iframe>

                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">

                <div class="three-col-wrapper latest-tab-wrapp">
                    <div class="latest-tab-wrapper">
                        <ul class="nav nav-tabs latest-tab">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">ताजा अपडेट</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">लोकप्रिय</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <ul class="latest-news">
                                    @foreach($latest_news as $news)
                                    <li><a href="{{route('postInner',$news->slug)}}" class="latest-title"><h3>{{$news->title}}</h3></a></li>
                                    @endforeach
                                    

                                </ul>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <ul class="latest-news">
                                    @foreach($trendings as $trend)
                                    <li><a href="{{route('postInner',$trend->slug)}}" class="latest-title"><h3>{{$trend->title}}</h3></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection