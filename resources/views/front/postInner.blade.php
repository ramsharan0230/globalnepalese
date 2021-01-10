
@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<style>
    #st-1 .st-btn[data-network='sharethis'],
    #st-3 .st-btn[data-network='sharethis'] {
        display: none !important;
    }
    
     .st-btn[data-network="facebook"],
      .st-btn[data-network="twitter"] {
        display: inline-block !important;
    }
   
    
</style>

<?php
$maintitle = \App\Models\Advert::where("sections", "like", "%" . 'Above main title inner page' . "%")->get();
$below_news = \App\Models\Advert::where("sections", "like", "%" . 'Below news content' . "%")->get();

$below_lok = \App\Models\Advert::where("sections", "like", "%" . 'Below news content' . "%")->get();
?>
<section class="detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-12 mb-4">
                <div class="detail-page-wrapper">
                    @if($maintitle->count())
                    <section class="body-ad">
                        <div class="container">
                            @foreach($maintitle as $mainadvert)
                            <div class="body-ad-wrapper">
                                <a target="_blank" href="{{$mainadvert->link}}"><img src="{{asset('images/'.$mainadvert->image)}}" alt="ad"></a>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                    <div class="three-col-wrapper detail-container">
                        <div class="detail-title-wrapper">
                            <h3>{{$post->title}}</h3>

                        </div>
                        <div class="admin-user">
                            <div class="admin">
                                <div class="d-flex align-items-center position-relative reporterWrapper">
                                    @if($post->reporter_image)
                                    <img class="d-block" src="{{asset('images/reporter/'.$post->reporter_image)}}" alt="admin">
                                    @endif
                                    <span style="margin-left: 10px;"> {{$post->reporter}}</span>
                                    {{--
                                     @if($post->reporter_image)
                                    <a target="_blank" href="{{$post->reporter_fb}}">
                                        <i class="fa fa-facebook reporter__social reporter__fb"></i>
                                    </a>
                                    <a target="_blank" href="{{$post->reporter_twitter}}">
                                        <i class="fa fa-twitter reporter__social reporter__tw"></i>
                                    </a>
                                    @endif
                                    --}}
                                </div>
                                <span class=" detail-date samachar-date"><i class="fa fa-calendar" aria-hidden="true"></i>{{$calendar->NEP_DATE_TIME($post->created_at)}}
                                    <!--<span class=" ml-3 samachar-date"><i class="fa fa-eye mr-1"></i> {{ $post->view }} views</span>-->

                                </span>
                            </div>
                            <ul class="shares float-right">
                                <div class="sharethis-inline-share-buttons"></div>
                            </ul>
                        </div>
                        @if($post->image)
                        <img src="{{asset('images/main/'.$post->image)}}" alt="image">
                        @else
                        <img src="{{asset('front/images/demo.png')}}" alt="news">
                        @endif

                        <p>{!!$post->description!!}</p>
                        @if($below_news->count())
                        <section class="body-ad">
                            <div class="container">
                                @foreach($below_news as $belowadvert)
                                <div class="body-ad-wrapper">
                                    <a target="_blank" href="{{$belowadvert->link}}"><img src="{{asset('images/'.$belowadvert->image)}}" alt="ad"></a>
                                </div>
                                @endforeach
                            </div>
                        </section>
                        @endif
                         <div>
                            <ul class="shares float-right mb-4">
                                <div class="sharethis-inline-share-buttons"></div>
                            </ul>
                        </div>
                        <?php
                        $url = Request::url();
                        ?>
                        <div class="fb-comments" data-href="{{$url}}" data-numposts="5" data-width="100%"></div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="three-col-wrapper latest-tab-wrapp">
                    <div class="latest-tab-wrapper">
                        <ul class="nav nav-tabs latest-tab">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">ताजा
                                    अपडेट</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">लोकप्रिय</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <ul class="latest-news">
                                    @foreach($latest_news as $news)
                                    <li><a href="{{route('postInner',$news->slug)}}" class="latest-title">
                                            <h3>{{$news->title}}</h3>
                                        </a></li>
                                    @endforeach


                                </ul>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <ul class="latest-news">
                                    @foreach($trendings as $trend)
                                    <li><a href="{{route('postInner',$trend->slug)}}" class="latest-title">
                                            <h3>{{$trend->title}}</h3>
                                        </a></li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($below_lok as $lok)
                <a href="{{$lok->link}}" class="samachar-ad list-ad"><img src="{{asset('images/'.$lok->image)}}" alt="ad"></a>
                @endforeach

            </div>

            <div class="col-12">
                <div class="three-col-wrapper samachar-first-col">
                    <a href="list.php" class="all-title video-category">
                        <h2>अन्य</h2>
                    </a>
                    <div class="row">
                        @foreach($related_posts as $related)
                        <div class="col-lg-4 mb-3">
                            <div class="samachar-wrapper">
                                <a href="{{route('postInner',$related->slug)}}" class="samachar-image">
                                    @if($related->image)
                                    <img src="{{asset('images/medium/'.$related->image)}}" alt="news">
                                    @else
                                    <img src="{{asset('front/images/demo.png')}}" alt="news">
                                    @endif

                                </a>
                                <a href="{{route('postInner',$related->slug)}}" class="samachar-title">
                                    <h3>
                                        {{$related->title}}</h3>
                                </a>
                                <span class="samachar-date">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>{{$calendar->NEP_DATE_TIME($related->created_at)}}
                                </span>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
