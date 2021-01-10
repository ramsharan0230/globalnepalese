@extends('layouts.front')
@section('content')
 <div class="padding_5 p-a0 container">
			<div class="row equal_height">
				<div class="col-md-12 col-sm-12 col-xs-12 p-lr5">
		            <div class="row equal_height">
		                <div class="col-md-12 col-sm-12 col-xs-12 p-lr0">
		                    <h4 class="text-uppercase p-l15 head_title p-lr5">
		                        <span class="fa fa-coffee"></span>
		                        ताजा भिडियोहरु
		                        <!-- <span class="all_news_link">
		                            <a href="">
		                                थप
		                                <span class=" fa fa-ellipsis-v"></span>
		                            </a>
		                        </span> -->
		                    </h4>
		                </div>
		            </div>
		        </div>
		        @foreach($latest_video1 as $video1)
		        <div class="col-md-6 col-sm-6 col-xs-12 p-lr5 p-t10 m-b20">
		        	<div class="row equal_height">
		        		<div class="col-md-12 col-sm-12 col-xs-12 p-lr0 p-t0 p-b40">
	            			<div class="height_manage main_video ">
			    				<iframe src="https://www.youtube.com/embed/{{$video1->youtubeVideo($video1->link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			    				<div class="wt-post-title ">
			                        <h3 class="post-title main_youtube_title video_hover" >
			                            <a href="">
			                                {{$video1->title}}
			                            </a>
			                        </h3>
			                    </div>
			    			</div>
	            		</div>
		            </div>
				</div>
				@endforeach
				<div class="col-md-6 col-sm-6 col-xs-12 p-lr0 p-t10 m-b20">
		        	<div class="row equal_height p-lr0">
		        		@foreach($latest_video2 as $video2)
		        		<div class="col-md-6 col-sm-6 col-xs-6 p-lr0 p-t0 p-b40">
	            			<div class="height_manage">
	            				<iframe width="400px" src="https://www.youtube.com/embed/{{$video2->youtubeVideo($video2->link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	            				<div class="wt-post-title ">
	                                <h3 class="post-title side_video video_hover">
	                                    <a href="">
	                                        {{$video2->title}}
	                                    </a>
	                                </h3>
	                            </div>
	            			</div>
	            		</div>
	            		@endforeach
	            		
		            </div>
				</div>

			 
				 
				<div class="col-md-12 col-sm-12 col-xs-12 p-lr5">
		            <div class="row equal_height">
		                <div class="col-md-12 col-sm-12 col-xs-12 p-lr0">
		                    <h4 class="text-uppercase p-l15 head_title p-lr5">
		                        <span class="fa fa-coffee"></span>
		                        सबै भिडियोहरु
		                        <!-- <span class="all_news_link">
		                            <a href="">
		                                थप
		                                <span class=" fa fa-ellipsis-v"></span>
		                            </a>
		                        </span> -->
		                    </h4>
		                </div>
		            </div>
		        </div>
		        @foreach($videos as $video)
		        <div class="col-md-3 col-sm-6 col-xs-6 p-lr0 p-t0 p-b40">
        			<div class="height_manage">
        				<iframe width="400px" src="https://www.youtube.com/embed/{{$video->youtubeVideo($video->link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        				<div class="wt-post-title ">
                            <h3 class="post-title side_video video_hover">
                                <a href="">
                                    {{$video->title}}
                                </a>
                            </h3>
                        </div>
        			</div>
        		</div>
        		@endforeach
        		
				<div class="col-md-12 col-sm-12 col-xs-12 p-lr5 p-t20 p-b20">
		            <ul class="pagination m-tb0 pull_right">
                   		{{$videos->links()}}
                    </ul>
		        </div>
 
			</div>
		</div>
@endsection