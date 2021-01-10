@extends('layouts.front')
@section('content')

{{-- <section class="body-ad">
    <div class="container">
        <div class="body-ad-wrapper">
            <a href="#"><img src="/front/images/1559487824.gif" alt="ad"></a>
        </div>
    </div>
</section> --}}

<section class="top-news">
    <div class="container">

        @foreach($home1 as $home)
        <div class="top-news-wrapp mt-4">
            <a href="{{route('postInner',$home->slug)}}" class="top-main-title">
                <h2> {{$home->title}}</h2>
            </a>
        </div>
        @endforeach

    </div>
</section>
<!-- top news section ends -->

<!-- top news with image section starts -->
<section class="top-news-with-image">
    <div class="container">
        @foreach($home2 as $home2)
        <div class="with-image-wrapper">
            <a class="top-main-title with-image-title" href="{{route('postInner',$home2->slug)}}">
                <h2>{{$home2->title}}</h2>
            </a>
            <span class="admin">{{$home2->reporter}}</span>
            <a class="top-news-image" href="{{route('postInner',$home2->slug)}}">
                @if($home2->image)
                <img src="{{asset('images/main/'.$home2->image)}}" alt="news">
                @else
                <img src="{{asset('front/images/demo.png')}}" alt="news">
                @endif</a>
            <p>{{$home2->short_description}}</p>
        </div>
        @endforeach
    </div>
</section>
<?php
    $below_main_news = $dashboard_advert->where("sections", "like", "%" . 'Below main photo news' . "%")->get();
    //dd($below_main_news);
    $dristikon_avert = \App\Models\Advert::where("sections", "like", "%" . 'Above Dristikon' . "%")->get();

    $above_feature = \App\Models\Advert::where("sections", "like", "%" . 'Above feature' . "%")->get();

    $above_sahitya = \App\Models\Advert::where("sections", "like", "%" . 'Above sahitya' . "%")->get();
    $khelkudadvert = \App\Models\Advert::where("sections", "like", "%" . 'Above khelkud' . "%")->get();
    $multimediaadvert = \App\Models\Advert::where("sections", "like", "%" . 'Above Multimedia' . "%")->get();



    ?>
@if(count($below_main_news)>0)
<!-- top news with image section ends -->
<section class="body-ad">
    <div class="container">
        <div class="body-ad-wrapper">
            @foreach($below_main_news as $below)
            <a target="_blank" target="_blank" href="{{$below->link}}"><img src="{{asset('images/'.$below->image)}}" alt="ad"></a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!--<div class="row">-->
    <div class="container">
        <iframe src="https://coronanepal.live/embed/" style="min-height:320px;width:100%!important;overflow-y:hidden;margin-top:10px!important;"></iframe >
    </div>    
<!--</div>   -->
<br>

<!-- three block section starts -->
<section class="three-col-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6 order-lg-first order-md-second  col-12">
                <div class="three-col-wrapper samachar-first-col">
                    <a href="{{route('category',['samachar'])}}" class="all-title video-category">
                        <h2>समाचार</h2>
                    </a>

                    @foreach($samachar->posts as $news)
                    <div class="samachar-wrapper">
                        <a href="{{route('postInner',$news->slug)}}" class="samachar-image"> @if($news->image)
                            <img src="{{asset('images/medium/'.$news->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$news->slug)}}" class="samachar-title">
                            <h3>
                                {{$news->title}}
                            </h3>
                        </a>
                        <span class="samachar-date">
                            <i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($news->dateandtime ?? $news->created_at)}}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6 col-md-12 order-lg-second order-md-first col-12">
                <div class="three-col-wrapper three-col-wrapp">
                    <a href="{{route('category',['perspective'])}}" class="all-title video-category">
                        <h2>प्रवास </h2>
                    </a>

                    @foreach($prabash->posts as $dristi)
                    <div class="samachar-wrapper samachar-big">
                        <a href="{{route('postInner',$dristi->slug)}}" class="samachar-image">
                            @if($dristi->image)
                            <img src="{{asset('images/medium/'.$dristi->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif


                        </a>
                        <a href="{{route('postInner',$dristi->slug)}}" class="samachar-title">
                            <h3>
                                {{$dristi->title}}
                            </h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($dristi->dateandtime ?? $dristi->created_at)}}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
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

                                    @foreach($latest_news as $latest)
                                    <li>
                                        <a href="{{route('postInner',$latest->slug)}}" class="latest-title">
                                            <h3>
                                                {{$latest->title}}
                                            </h3>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <ul class="latest-news">
                                    @foreach($trendings as $trending)
                                    <li>
                                        <a href="{{route('postInner',$trending->slug)}}" class="latest-title">
                                            <h3>
                                                {{$trending->title}}
                                            </h3>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($dristikon_avert)>0)
                @foreach($dristikon_avert as $dadvert)

                <a target="_blank" href="{{$dadvert->link}}" class="samachar-ad list-ad"><img
                        src="{{asset('images/'.$dadvert->image)}}" alt="ad"></a>
                @endforeach
                @endif

                <div class="three-col-wrapper bichar-wrapp">
                    <a href="{{route('category',['foreign'])}}" class="all-title video-category">
                        <h2>दृष्टिकोण</h2>
                    </a>

                    @foreach($dristikon->posts as $perspective)
                    <div class="bichar-wrapper">
                        <a href="{{route('postInner',$perspective->slug)}}" class="bichar-title">
                            <h3>
                                {{$perspective->title}}
                            </h3>
                            <span>{{$perspective->reporter}}</span>
                        </a>
                        <a href="{{route('postInner',$perspective->slug)}}" class="bichar-image">
                            @if($perspective->image)
                            <img src="{{asset('images/listing/'.$perspective->image)}}" alt="image">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- three block section ends -->
@if(count($above_feature)>0)
<section class="body-ad">
    <div class="container">
        @foreach($above_feature as $fadvert)
        <div class="body-ad-wrapper">
            <a target="_blank" href="{{$fadvert->link}}"><img src="{{asset('images/'.$fadvert->image)}}" alt="ad"></a>
        </div>
        @endforeach
    </div>
</section>
@endif
<!-- artha section starts -->
<section class="interview">
    <div class="container">
        <div class="three-col-wrapper">
            <a href="{{route('category',['feature'])}}" class="all-title video-category">
                <h2>फिचर</h2>
            </a>
            <div class="row">
                @foreach($feature->posts as $feat)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="samachar-wrapper samachar-big inter-news interview">
                        <a href="{{route('postInner',$feat->slug)}}" class="samachar-image">
                            @if($feat->image)
                            <img src="{{asset('images/medium/'.$feat->image)}}" alt="news"></a>
                        @else
                        <img src="{{asset('front/images/demo.png')}}" alt="news">
                        @endif

                        <a href="{{route('postInner',$feat->slug)}}" class="samachar-title">
                            <h3>{{$feat->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($feat->dateandtime ?? $feat->created_at)}}</span>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
@if(count($above_sahitya)>0)
<section class="body-ad">
    <div class="container">
        @foreach($above_sahitya as $sadvert)
        <div class="body-ad-wrapper">
            <a target="_blank" href="{{$sadvert->link}}"><img src="{{asset('images/'.$sadvert->image)}}" alt="ad"></a>
        </div>
        @endforeach
    </div>
</section>
@endif

<section class="interview">
    <div class="container">
        <div class="three-col-wrapper">
            <a href="{{route('category',['literature'])}}" class="all-title video-category">
                <h2>साहित्य</h2>
            </a>
            <div class="row">
                @foreach($sahitya->posts as $litrature)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="samachar-wrapper samachar-big inter-news interview">
                        <a href="{{route('postInner',$litrature->slug)}}" class="samachar-image">
                            @if($litrature->image)
                            <img src="{{asset('images/medium/'.$litrature->image)}}" alt="news"></a>
                        @else
                        <img src="{{asset('front/images/demo.png')}}" alt="news">
                        @endif

                        <a href="{{route('postInner',$litrature->slug)}}" class="samachar-title">
                            <h3>{{$litrature->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($litrature->dateandtime ?? $litrature->created_at)}}</span>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
</section>

<!-- artha section ends -->
@if(count($khelkudadvert)>0)
<section class="body-ad">
    <div class="container">
        @foreach($khelkudadvert as $kadvert)
        <div class="body-ad-wrapper">
            <a target="_blank" href="{{$kadvert->link}}"><img src="{{asset('images/'.$kadvert->image)}}" alt="ad"></a>
        </div>
        @endforeach
    </div>
</section>
@endif
<!-- Sports section starts-->
<section class="interview">
    <div class="container">
        <div class="three-col-wrapper">
            <a href="{{route('category',['interview'])}}" class="all-title video-category">
                <h2>अन्तर्वार्ता</h2>
            </a>
            <div class="row">
                @foreach($khelkud->posts as $khel)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="samachar-wrapper samachar-big inter-news interview">
                        <a href="{{route('postInner',$khel->slug)}}" class="samachar-image">
                            @if($khel->image)
                            <img src="{{asset('images/medium/'.$khel->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif
                        </a>
                        <a href="{{route('postInner',$khel->slug)}}" class="samachar-title">
                            <h3>{{$khel->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($khel->dateandtime ?? $khel->created_at)}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- four block section starts -->
<section class="four-block">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-12">
                <div class="three-col-wrapper three-col-wrapp">
                    <a href="{{route('category',['jiwan-jagat'])}}" class="all-title kalaa-category video-category">
                        <h2>जीवन जगत</h2>
                    </a>
                    @foreach($jiwanjagat->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->take(1)->get() as $jiwan)
                    <div class="samachar-wrapper samachar-big inter-news interview sports">
                        <a href="{{route('postInner',$jiwan->slug)}}" class="samachar-image">
                            @if($jiwan->image)
                            <img src="{{asset('images/medium/'.$jiwan->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$jiwan->slug)}}" class="samachar-title">
                            <h3>{{$jiwan->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($jiwan->dateandtime ?? $jiwan->created_at)}}</span>
                    </div>
                    @endforeach
                    @if(count($jiwanjagat->posts)>1)
                    @foreach($jiwanjagat->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->skip(1)->take(4)->get() as $jagat)
                    <div class="artha-wrapper four-block-wrapper">
                        <a href="{{route('postInner',$jagat->slug)}}" class="artha-image">
                            @if($jagat->image)
                            <img src="{{asset('images/medium/'.$jagat->image)}}" alt="image">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$jagat->slug)}}" class="artha-title">
                            <h3>{{$jagat->title}}</h3>
                            <span class="samachar-date"><i class="fa fa-calendar"
                                    aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($jagat->dateandtime ?? $jagat->created_at)}}</span>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="three-col-wrapper three-col-wrapp">
                    <a href="{{route('category',['tourisim'])}}" class="all-title kalaa-category video-category">
                        <h2>खेलकुद</h2>
                    </a>
                    @foreach($paryatan->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->take(1)->get() as $paryatan1)
                    <div class="samachar-wrapper samachar-big inter-news interview sports">
                        <a href="{{route('postInner',$paryatan1->slug)}}" class="samachar-image">
                            @if($paryatan1->image)
                            <img src="{{asset('images/medium/'.$paryatan1->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$paryatan1->slug)}}" class="samachar-title">
                            <h3>{{$paryatan1->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($paryatan1->dateandtime ?? $paryatan1->created_at)}}</span>
                    </div>
                    @endforeach
                    @if(count($paryatan->posts)>1)
                    @foreach($paryatan->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->skip(1)->take(4)->get() as $paryatan2)
                    <div class="artha-wrapper four-block-wrapper">
                        <a href="{{route('postInner',$paryatan2->slug)}}" class="artha-image">
                            @if($paryatan2->image)
                            <img src="{{asset('images/medium/'.$paryatan2->image)}}" alt="image">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$paryatan2->slug)}}" class="artha-title">
                            <h3>{{$paryatan2->title}}</h3>
                            <span class="samachar-date"><i class="fa fa-calendar"
                                    aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($paryatan2->dateandtime ?? $paryatan2->created_at)}}</span>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="three-col-wrapper">
                    <a href="{{route('category',['market'])}}" class="all-title kalaa-category video-category">
                        <h2>बजार</h2>
                    </a>
                    @foreach($bazar->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->take(1)->get() as $bazar1)
                    <div class="samachar-wrapper samachar-big inter-news interview sports">
                        <a href="{{route('postInner',$bazar1->slug)}}" class="samachar-image">
                            @if($bazar1->image)
                            <img src="{{asset('images/medium/'.$bazar1->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$bazar1->slug)}}" class="samachar-title">
                            <h3>{{$bazar1->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($bazar1->dateandtime ?? $bazar1->created_at)}}</span>
                    </div>
                    @endforeach
                    @if(count($bazar->posts)>1)
                    @foreach($bazar->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->skip(1)->take(4)->get() as $bazar2)
                    <div class="artha-wrapper four-block-wrapper">
                        <a href="{{route('postInner',$bazar2->slug)}}" class="artha-image">
                            @if($bazar2->image)
                            <img src="{{asset('images/medium/'.$bazar2->image)}}" alt="image">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$bazar2->slug)}}" class="artha-title">
                            <h3>{{$bazar2->title}}</h3>
                            <span class="samachar-date"><i class="fa fa-calendar"
                                    aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($bazar2->dateandtime ?? $bazar2->created_at)}}</span>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="three-col-wrapper">
                    <a href="{{route('category',['english'])}}" class="all-title kalaa-category video-category">
                        <h2>English</h2>
                    </a>
                    @foreach($prabidhi->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->take(1)->get() as $prabidhi1)
                    <div class="samachar-wrapper samachar-big inter-news interview sports">
                        <a href="{{route('postInner',$prabidhi1->slug)}}" class="samachar-image">
                            @if($prabidhi1->image)
                            <img src="{{asset('images/medium/'.$prabidhi1->image)}}" alt="news">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$prabidhi1->slug)}}" class="samachar-title">
                            <h3>{{$prabidhi1->title}}</h3>
                        </a>
                        <span class="samachar-date"><i class="fa fa-calendar"
                                aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($prabidhi1->dateandtime ?? $prabidhi1->created_at)}}</span>
                    </div>
                    @endforeach
                    @if(count($prabidhi->posts)>1)
                    @foreach($prabidhi->posts()->orderBy('created_at','desc')->where('dateandtime', '<=', date('Y-m-d H:i'))->skip(1)->take(4)->get() as $prabidhi2)
                    <div class="artha-wrapper four-block-wrapper">
                        <a href="{{route('postInner',$prabidhi2->slug)}}" class="artha-image">
                            @if($prabidhi2->image)
                            <img src="{{asset('images/medium/'.$prabidhi2->image)}}" alt="image">
                            @else
                            <img src="{{asset('front/images/demo.png')}}" alt="news">
                            @endif

                        </a>
                        <a href="{{route('postInner',$prabidhi2->slug)}}" class="artha-title">
                            <h3>{{$prabidhi2->title}}</h3>
                            <span class="samachar-date"><i class="fa fa-calendar"
                                    aria-hidden="true"></i>{{$calendar->ENG_TO_NEP_TIME($prabidhi2->dateandtime ?? $prabidhi2->created_at)}}</span>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
<!-- four block section ends -->
@if(count($multimediaadvert)>0)
<section class="body-ad">
    <div class="container">
        @foreach($multimediaadvert as $madvert)
        <div class="body-ad-wrapper">
            <a target="_blank" href="{{$madvert->link}}"><img src="{{asset('images/'.$madvert->image)}}" alt="ad"></a>
        </div>
        @endforeach
    </div>
</section>
@endif
<!-- video section starts -->
<section class="video-section">
    <div class="container">
        <div class="video-wrapper">
            <a href="list.php" class="video-category">
                <h2>मल्टिमिडिया</h2>
            </a>
            @foreach($videos->take(1) as $video)
            <div class="vid-wrapp">
                <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/{{$video->youtubeVideo($video->link)}}" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <div class="vid-title-wrapper">
                    <a href="#" class="vid-title">
                        <h2>{{$video->title}}</h2>
                    </a>
                    <!-- <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i>Jan 20,2020</span> -->
                                      <ul class="media">
                        <li><a href="{{$dashboard_composer->facebook}}"><i class="fa fa-facebook-official"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{$dashboard_composer->twitter}}"><i class="fa fa-twitter-square"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{$dashboard_composer->instagram}}"><i class="fa fa-instagram"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{$dashboard_composer->square}}"><i class="fa fa-youtube-square"
                                    aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            @endforeach
            <div class="vid-slider">
                @foreach($videos1 as $vid2)
                <div class="vid-container">
                    <a target="_blank" href="{{ $vid2->link }}" class="vid-slider-wrapper">
                        <div class="vid-thumb">
                            <img src="https://img.youtube.com/vi/{{$vid2->youtubeVideo($vid2->link)}}/hqdefault.jpg"
                                alt="thumb">
                        </div>
                        <div class="vid-slide-title">
                            <h3>{{$vid2->title}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- video section ends -->
@endsection