@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<section class="list-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-12">
                <div class="three-col-wrapper list-page-whole-wrapp">
                    <a href="#" class="all-title video-category">
                        <h2>{{$trend->title}}</h2>
                    </a>
                    <div class="list-news">
                        @foreach($posts as $post)
                        <div class="list-news-wrapp">
                            <a href="{{route('postInner',$post->slug)}}" class="list-news-title">
                                <h3>{{$post->title}}</h3>
                            </a>
                            <div class="list-news-image-wrapper">
                                <a href="{{route('postInner',$post->slug)}}" class="list-news-image"><img src="{{asset('images/medium/'.$post->image)}}" alt="news"></a>
                                <div class="list-news-content">
                                    <p>{{$post->short_description}}
                                    </p>
                                    <span class="samachar-date"><i class="fa fa-calendar" aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($post->created_at)}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    {{$posts->links()}}
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
                                    @foreach($latest_news as $last)
                                    <li><a href="{{route('postInner',$last->slug)}}" class="latest-title"><h3>{{$last->title}}</h3></a></li>
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