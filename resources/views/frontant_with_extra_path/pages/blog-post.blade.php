@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{ $title ?? 'Career'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('main-content')
<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-10 col-md-offset-1">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">{{$blog->title}}</h1>
                <!-- page-title end -->

                <!-- blogpost start -->
                <article class="clearfix blogpost full">
                    <div class="blogpost-body">
                        <div class="side">
                            <div class="post-info">
                                <span class="day">{{Carbon\Carbon::parse($blog->created_at)->format('d')}}</span>
                                <span class="month">{{Carbon\Carbon::parse($blog->created_at)->format('M
                                    Y')}}</span>
                            </div>
                            {{-- <div id="affix"><span class="share">Share This</span>
                                <div id="share"></div>
                            </div> --}}
                        </div>
                        <div class="blogpost-content">
                            {{-- <header>
                                <div class="submitted"><i class="fa fa-user pr-5"></i> by <a href="blog-post.html#">John
                                        Doe</a></div>
                            </header> --}}
                            @if(!empty($blog->image))
                            <div class="owl-carousel content-slider-with-controls">
                                <div class="overlay-container">
                                    <img src="{{ asset('public/backend/blog/'.$blog->image) }}"
                                        alt="{{ $blog->alt ?? 'IT Way BD' }}">
                                    <a href="{{ asset('public/backend/blog/'.$blog->image) }}" class="popup-img overlay"
                                        title="image title"><i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                            @endif
                            {!! $blog->description !!}
                        </div>
                    </div>
                    <!--<footer class="clearfix">-->
                    <!--    <ul class="links pull-left">-->
                    <!--        <li><i class="fa fa-comment-o pr-5"></i> <a href="blog-post.html#">22 comments</a> |</li>-->
                    <!--        <li><i class="fa fa-tags pr-5"></i> <a href="blog-post.html#">tag 1</a>, <a-->
                    <!--                href="blog-post.html#">tag 2</a>, <a href="blog-post.html#">long tag 3</a> </li>-->
                    <!--    </ul>-->
                    <!--</footer>-->
                    
                    <div class="post-share">
                        <div>Share:</div>    {!! Share::currentPage()->facebook()->twitter()->linkedin()->whatsapp() !!}
                    </div>
                </article>
                <!-- blogpost end -->
            </div>
            <!-- main end -->


        </div>
    </div>
</section>
<!-- main-container end -->

@endsection