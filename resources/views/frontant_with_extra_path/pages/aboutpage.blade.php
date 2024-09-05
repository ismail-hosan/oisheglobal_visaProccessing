@extends('frontant_with_extra_path.layouts.master')

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('title')
 {{$aboutpage->title??"N/A"}}
@endsection

@section('page-intro')
<li><a class="active">About Us</a></li>
@endsection


@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">


                @if ($aboutpage->tagline)
                <p>{{$aboutpage->tagline}}</p>
                @endif
                <hr>
                <!-- page-title end -->
                <div class="row">
                    <div class="{{$aboutpage->image ? 'col-md-6' : 'col-md-9'}}">
                        {!! $aboutpage->description !!}

                    </div>
                    <!-- sidebar start -->

                    @if($aboutpage->image)
                    <aside class="sidebar col-md-6">
                        <img class="img-responsive col-xs-12"
                            src="{{asset('public/backend/aboutus/'. $aboutpage->image)}}" width="900px" height="auto"
                            alt="{{ $aboutpage->alt ?? 'IT Way BD' }}">
                    </aside>
                    @endif
                    <!-- sidebar end -->
                </div>

            </div>
        </div>
    </div>
</section>


@endsection