@extends('frontant_with_extra_path.layouts.master')

@section('title')
Overview
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li><a class="active">Overview</a></li>
@endsection
<style>
    .overlay-container img{
        height: 100px;
    }
</style>

@section('main-content')

<!-- section start -->
<!-- ================ -->

{{-- <div class="section gray-bg clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12"></div>
            <h1 class="page-title">Our Testimunials</h1>
            <div class="separator-2"></div>
        </div>
    </div>
    <div class="owl-carousel content-slider">
        @if(!$testimunials->isEmpty())
        @foreach($testimunials as $value)
        <div class="testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="testimonial-image">

                            <img src="{{asset('public/backend/testimonial/'.$value->image)}}"
alt="{{ $value->alt ?? 'IT Way BD' }}" class="img-circle fixed-dimention bordered">

</div>
<div class="testimonial-body">
    <div>{!! $value->message ?? "N/A" !!}</div>
    <div class="testimonial-info-1">- {{$value->customer->name}}</div>
</div>
</div>
</div>
</div>
</div>
@endforeach
@endif
</div>
</div> --}}

<div class="section clearfix">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <h2>Our Respected Client</h2> --}}
                {{-- <h2 class="text-center"><span class="bottom-line">Respected Client</span></h2> --}}
                <h2 class="text-center"><span
                        style="background: #10245a;color:#fff;border-radius:10px 0px;padding:0px 5px;font-size:32px;">Our</span> <span
                        style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff; font-size:32px;">Partnership</span>
                </h2>
                {{-- <div class="separator-2"></div> --}}
                <div class="owl-carousel carousel">
                    
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                           <img src="{{ asset('/public/frontant/images/basis.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/bkash.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/amazon.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/basis.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/gpartner.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/dell.png')}}" alt="">
                        </div>
                    </div>
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{ asset('/public/frontant/images/mspartner.png')}}" alt="">
                        </div>
                    </div>

                </div>
    
            </div>
        </div>
    </div>
    
</div>


<!-- section end -->

@endsection