@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
Our Testimunials
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li><a class="active">Our Testimunials</a></li>
@endsection

<style>
    .testimonial-item {
    background: #fff;
    box-shadow: 5px 10px 5px #f2f2f2;
    padding: 30px;
    height: 327px;
    text-align: center;
    margin: 0px 10px
    }
    .testimonial-item img {
    margin: 0 auto;
    border-radius: 50%;
    border: 5px solid #eeeeee;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    }
    .testimonial-item p{
    margin: 20px auto;
    max-width: 600px;
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

@if($testimunials->isNotEmpty())
<div class="section clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pb-25px">
                {{-- <h2 class="title text-center text-Uppercase animate-charcter">CLIENTS FEEDBACK</h2> --}}
                <h2 class="text-center"><span
                        style="background: #10245a;color:#fff;border-radius:10px 0px;padding:0px 5px">Our</span>
                    <span style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff;">FEEDBACK</span>
                </h2>
            </div>
        </div>
    </div>
    <div class="owl-carousel content-slider">
        @foreach($testimunials as $value)
        <div class="testimonial-item">

            <img src="{{asset('public/backend/testimonial/'.$value->image)}}" alt="{{ $value->alt ?? 'IT Way BD' }}"
                class="img-circle fixed-dimention bordered">


            <p>{!!$value->message!!}</p>
            <div class="testimonial-info-1" style="color: #e84c3d"><b>- {{$value->customer->name ?? 'N/A'}}</b></div>

        </div>
        @endforeach
    </div>
</div>
@endif

<!-- section end -->

@endsection