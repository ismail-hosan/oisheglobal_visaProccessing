@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{ $title ?? 'Blog'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a class="active">{{ $title ?? 'Blog'}}</a></li>
@endsection


@section('main-content')
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-10 col-md-offset-1">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">PHOTOS</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                @forelse ($blogs as $blog)
                <!-- blogpost start -->
                <article class="clearfix blogpost object-non-visible" data-animation-effect="fadeInUpSmall"
                    data-effect-delay="200">
                    <div class='row'>
                    @if(!empty($blog->image))
                        <div class="col-sm-3">
                            <div class="overlay-container">
                                <img class="block-center" src="{{ asset('public/backend/blog/'.$blog->image) }}"
                                    alt="{{ $blog->alt ?? 'IT Way BD' }}">
                                <div class="overlay">
                                    <div class="overlay-links">
                                        <a href="{{ route('blogs.show', ['slug'=>$blog->slug]) }}"><i
                                                class="fa fa-link"></i></a>
                                        <a href="{{ asset('public/backend/blog/'.$blog->image) }}" class="popup-img-single"
                                            title="image title"><i class="fa fa-search-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                         <div class="{{ !empty($blog->image) ? 'col-sm-9' : 'col-md-12' }}">
                            <div class="blogpost-body">
                                <div class="post-info">
                                    <span class="day">{{Carbon\Carbon::parse($blog->created_at)->format('d')}}</span>
                                    <span class="month">{{Carbon\Carbon::parse($blog->created_at)->format('M
                                        Y')}}</span>
                                </div>
                                <div class="blogpost-content">
                                    <header>
                                        <h2 class="title">
                                            <a href="{{ route('blogs.show', ['slug'=>$blog->slug]) }}">{{$blog->title ??
                                                'N/A'}}
                                            </a>
                                        </h2>
                                    </header>
                                    <p style="margin-top:12px;">
                                        {{$blog->short_description ?? 'N/A'}}
                                    </p>
                                </div>
                            </div>
                            <footer class="clearfix">
                                <a class="pull-right link" href="{{ route('blogs.show', ['slug'=>$blog->slug]) }}"><span>Read
                                        more</span></a>
                            </footer>
                        </div>
                    
                    </div>
                    
                    
                </article>
                <!-- blogpost end -->
                @empty
                <article>
                    <div class="alert alert-danger">No data found!</div>
                </article>

                @endforelse

                {{$blogs->links() }}
                <!-- pagination end -->

            </div>
            <!-- main end -->
        </div>
    </div>
</section>


@endsection