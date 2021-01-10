@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<section class="detail-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="detail-container three-col-wrapper">
                    <h3 class="mb-3">पृष्ठ भेटिएन :</h3>
                   <p class="mb-3"> तपाईंले खोज्नुभएको पृष्ठ भेटिएन । पृष्ठ सारेको वा हटाईएको हुनसक्क्ष  </p>
                    <a href="/">
                        <p>गृहपृष्ठ जानुहोस
                        </p>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>


@endsection