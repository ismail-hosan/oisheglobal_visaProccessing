@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{ $title ?? 'Career'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a class="active">{{ $title ?? 'Career'}}</a></li>
@endsection


@section('main-content')
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-8 col-md-offset-2">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Career</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                @forelse ($careers as $career)
                <!-- blogpost start -->
                <article class="clearfix blogpost object-non-visible" data-animation-effect="fadeInUpSmall"
                    data-effect-delay="200">
                    <div class="blogpost-body">
                        <div class="post-info">
                            <span
                                class="day">{{Carbon\Carbon::parse($career->application_deadline)->format('d')}}</span>
                            <span class="month">{{Carbon\Carbon::parse($career->application_deadline)->format('M
                                Y')}}</span>
                        </div>
                        <div class="blogpost-content">
                            <header>
                                <h2 class="title"><a
                                        href="{{ route('careers.show', ['slug'=>$career->slug]) }}">{{$career->title ??
                                        'N/A'}}</a></h2>
                                <div class="submitted"><i class="fa fa-clock-o pr-5"></i> Published At
                                    {{Carbon\Carbon::parse($career->published_at)->format('d-m-Y')}}
                                    {{-- {{Carbon\Carbon::parse($career->application_deadline)->diffforhumans()}} --}}
                                </div>
                            </header>
                            <p>
                                {{$career->short_description ?? 'N/A'}}
                            </p>
                        </div>
                    </div>
                    <footer class="clearfix">
                        {{-- <ul class="links pull-left">

                        </ul> --}}
                        <a class="pull-right link"
                            href="{{ route('careers.show', ['slug'=>$career->slug]) }}"><span>Read more</span></a>
                    </footer>
                </article>
                <!-- blogpost end -->
                @empty

                <article>
                    <div class="alert alert-danger">No data found!</div>
                </article>

                @endforelse


                <!-- pagination start -->
                {{-- <ul class="pagination">
                    <li><a href="blog-right-sidebar.html#">«</a></li>
                    <li class="active"><a href="blog-right-sidebar.html#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="blog-right-sidebar.html#">2</a></li>
                    <li><a href="blog-right-sidebar.html#">3</a></li>
                    <li><a href="blog-right-sidebar.html#">4</a></li>
                    <li><a href="blog-right-sidebar.html#">5</a></li>
                    <li><a href="blog-right-sidebar.html#">»</a></li>
                </ul> --}}
                {{$careers->links() }}
                <!-- pagination end -->

            </div>
            <!-- main end -->
        </div>
    </div>
</section>


@endsection