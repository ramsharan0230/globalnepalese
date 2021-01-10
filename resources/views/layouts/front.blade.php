<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Global Nepalese - Nepali Daily News Online | Nepali News, Latest Politic,  Business, Literature, Sports, Entertainment, Travel, Life Style News Online</title>
    <meta  property="og:title" content="{{$og['title']}}">
    <meta  property="og:description" content="{{$og['description']}}">
    <meta  property="og:image" content="{{asset('images/main/'.$og['image'])}}">
    <meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{$og['title']}}">
<meta name="twitter:description" content="{{$og['description']}}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image:src" content="{{asset('images/main/'.$og['image'])}}">
    
    <link rel="icon" href="{{asset('images/thumbnail/'.$dashboard_composer->fav_icon)}}" type="image/gif">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/resposive.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171552841-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-171552841-1');
</script>

</head>

<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0"></script>
    <header id="header">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center divider__topbar">
                    <div class="col-lg">
                        <div class="top-head-wrapper">
                            <p class="header-date d-flex align-items-center" style="font-size: 12px !important;">
                                <span style="margin-right: 6px;"><?php echo date("M d, Y"); ?></span>
                                <iframe scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" style="padding-top: 0px; width: 50% !important;" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-time.php?dwn=only&font_color=333333&font_size=14&api=472154j013" height="22"></iframe></p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="trending-section">
                            <div>
                                <div class="trending-wrapper">
                                    <div id="trends" class="">
                                        <div class="inner">
                                            <ul style="list-style: none;" id="ticker" class="trendscontent">
                                                    @foreach($dashboard_tag as $key=>$tag)
                                                    <li data-key="{{$key+1}}">
                                                        <a href="{{route('trends',$tag->slug)}}">#{{$tag->title}}</a>
                                                    </li>
                                                    @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <h2 class="trending-title">ट्रेण्डिङ</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="middle-head">
            <div class="container">
                <div class="mid-head-wrapp">
                    <a href="{{route('home')}}" class="logo"><img class="top__header__image" src="{{asset('images/thumbnail/'.$dashboard_composer->logo)}}" alt="logo"></a>
                    <?php
                    $header = $dashboard_advert->where("sections", "like", "%" . 'Home header' . "%")->get();
                    
                    ?>
                    @foreach($header as $head)
                    <a target="_blank" href="{{$head->link}}" class="top-ad d-md-block"><img class="top__header__image" src="{{asset('images/'.$head->image)}}" alt="ad"></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="main-head-section">
            <div class="main-header">
                <div class="top-menu-bar">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </div>
                <a href="index.php" class="small-sticky-logo"><img src="{{asset('images/thumbnail/'.$dashboard_composer->logo)}}" alt="logo"></a>
                <div class="container">
                    <div class="main-head-wrapper">
                        <nav class="main-nav">
                            <a href="#" class="mobile-logo"><img src="{{asset('images/thumbnail/'.$dashboard_composer->logo)}}" alt="logo"></a>
                            <ul>
                                <li><a class="active" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                
                                @foreach($dashboard_category as $das_cat)
                                <li><a href="{{route('category',$das_cat->slug)}}">{{$das_cat->title}}</a></li>
                                @endforeach
                                
                                <!-- <li class="drop-menu"><a href="#">अन्य<i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                    <ul id="sub_menu">
                                        <li><a href="list.php">शिक्षा</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </nav>

                        <div class="search">
                            <div class="search-wrapper">
                                <!-- <span class="search"><i class="fa fa-search" aria-hidden="true"></i></span> -->
                                <div class="search-toggle">
                                    <button class="search-icon icon-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button class="search-icon icon-close">X</button>
                                </div>
                                <div class="search-container">
                                    <form action="{{route('search')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="text" name="q" id="search-terms" placeholder="Enter Keywords..." />
                                        <button type="submit" name="submit" value="Go" class="search-icon search-btn">search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <div class="blank-div"></div>

    <!-- header section ends -->
    @yield('content')
    <!-- footer section starts -->

<a id="button"></a>


<footer>
    <div class="main-footer all-sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <a href="#" class="footer-logo"><img src="{{asset('images/thumbnail/'.$dashboard_composer->footer_logo)}}"></a>
                     
                        <ul><!--  editorial team -->
                            <!-- <li>Executive by global nepalese news</li> -->
                            @foreach($dashboard_team as $team)
                            <li>{{$team->title}}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Contact</h3>
                        <ul>
                            <li>{{$dashboard_composer->phone}}</li>
                            <li>{{$dashboard_composer->address}}</li>
                            <li><a href="#">{{$dashboard_composer->email}}</a></li>
                            <!-- our news sites-->
                             <li style="margin1-top: 10px;">
                                <a style="font-weight: 600;color: white;border-radius: 10px;" href="https://www.southasiatime.com/">
                                    South Asia Time
                                </a></li>
                               <li style="margin1-top1: 10px;">
                                <a style="font-weight: 600;color: white;border-radius: 10px;" href="http://ldcnews.com/">
                                    LDC News Service</a>
                                </a></li>
                            <!-- End our news sites-->
                            <li style="margin-top: 10px;">
                                <a style="font-weight: 600;color: white;border-radius: 10px;" href="{{route('unicode')}}">
                                    Preeti/Unicode Conversion
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{route('category',['english'])}}">English</a></li>
                            <li><a href="{{route('category',['market'])}}">बजार</a></li>
                            <li><a href="{{route('category',['tourisim'])}}">पर्यटन</a></li>
                            <li><a href="{{route('category',['literature'])}}">साहित्य</a></li>
                            <li><a href="{{route('category',['interview'])}}">अन्तर्वार्ता </a></li>
                            <li><a href="{{route('category',['jiwan-jagat'])}}">जीवन जगत</a></li>
                            <li><a href="{{route('category',['perspective'])}}">दृष्टिकोण</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Follow Us</h3>
                        <ul class="footer-social-media">
                            <li><a href="{{$dashboard_composer->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{$dashboard_composer->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{$dashboard_composer->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="{{$dashboard_composer->youtube}}"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-section">
        <div class="container">
            <p>© 2020 globalnepalese.com |<a href="{{route('page',['about-us'])}}"> About us </a>| <a href="{{route('page',['terms-of-service'])}}">Terms of Service </a>| <a href="{{route('page',['privacy-policy'])}}"> Privacy Policy</a></p>
        </div>
    </div>
</footer>
  <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5ebcf56bfb20270012fd010a&product=inline-share-buttons&cms=sop'
        async='async'></script> 
  {{--  <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5ef5aaeb0e78e50012568442&product=inline-share-buttons&cms=sop'
        async='async'></script>--}}
<script src="{{asset('front/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/lightbox.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
<script type="text/javascript" id="cookieinfo"
	src="//cookieinfoscript.com/js/cookieinfo.min.js"
	data-bg="#645862"
	data-fg="#FFFFFF"
	data-link="#F1D600"
	data-cookie="CookieInfoScript"
	data-text-align="left"
	data-moreinfo="{{route('page',['privacy-policy'])}}"
    data-close-text="Got it!">
</script>

</body>

</html>