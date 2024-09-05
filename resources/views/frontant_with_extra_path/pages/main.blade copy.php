@extends('frontant_with_extra_path.layouts.master')


@section('main-content')

@include('frontant_with_extra_path.layouts.partials.slider')
<style>
    .testimonial-item {
        background: #10245a;
        box-shadow: 5px 10px 5px #0e0d0d;
        padding: 30px;
        max-width: 700px;
        width: 100%;
        z-index: 11;
        height: auto;
        text-align: center;
        margin: 0 auto !important;
    }

    .testimonial-item p {
        color: #fff;
    }

    .owl-carousel .owl-item>div {
        margin: 10px 20px;
    }

    .image-box.object-non-visible .overlay-container img {
        height: 100px;
        width: 100%;
        max-width: 293px;
    }

    .testimonial-item img {
        margin: 0 auto;
        border-radius: 50%;
        border: 5px solid #eeeeee;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .testimonial-item p {
        margin: 20px auto;
        max-width: 600px;
    }

    .about-box-item {
        padding: 15px;
        border: solid 1px #e6e6e6;
        margin-bottom: 15px;
        text-align: center;
        border: 1px solid #d8e3f6;
        display: block;
        border-radius: 4px;
        box-shadow: 5px 10px 5px #f2f2f2;
        -webkit-transition: all 0.4s ease-in;
        transition: all 0.4s ease-in;
        min-height: 180px;
    }

    .about-box-item img {
        width: 60px;
        height: 60px;
        margin: 0 auto;
    }

    .about-section-text p {
        margin-right: 50px;
    }

    .achieve-item {
        box-shadow: 5px 10px 5px #f1f1f1;
        padding: 8px;
        border: 1px solid #d8e3f6;
        margin: 10px 0px;
        -webkit-transition: all 0.2s ease-out;
        -moz-transition: all 0.2s ease-out;
        -ms-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;
    }

    .achieve-item img {
        height: 75px;
        margin: 0 auto;
    }

    .client-bg {
        background-image: url('public/frontant/images/cltech2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        overflow: hidden;
        width: 100%;
        opacity: 0.8;
        height: 100%;
    }
</style>
<!-- section start -->
<!-- ================ -->
<div class="section clearfix">
    <h1 class="d-none">Best website and top software development company in Dhaka Bangladesh</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <h2 class="text-center">About Us</h2> --}}
                {{-- <h2 class="text-center"><span --}}
                {{-- <h2 class="text-center" style="margin-bottom:50px;"><span style="background: #10245a;color:#fff;border-radius:10px 0px;padding:0px 5px">About</span> <span
                        style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff;">Us</span></h2> --}}
                <h2 class="text-center "><span class="bottom-line">About Us</span></h2>
                {{-- <div class="separator"></div> --}}
                <div class="row section">
                    <div class="col-md-6">
                        <h2 class="title" style="margin-right: 10px;font-size:21px;">{{$aboutus->title}}</h2>
                        <div class="row">
                            <div class="col-md-12 about-section-text">
                                <p>{!! \Illuminate\Support\str::limit(strip_tags($aboutus->description), 530) !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="r-btn">
                                <a href="{{route('menu.aboutus.overview')}}" class="btn btn-white">Explore About Us</a>
                            </div>
                        </div>
                        <div class="space hidden-md hidden-lg"></div>
                    </div>
                    <div class="col-md-6 about-section-img">
                        {{-- <img class="img" src="{{ asset('public/backend/aboutus/'.$aboutus->image) }}" alt="{{$aboutus->alt}}"> --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/suit.png')}}" alt="">
                                    <h3>5+</h3>
                                    <p>Years Experienced</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/target.png')}}" alt="">
                                    <h3>2k+</h3>
                                    <p>Happay Clients </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/coun.png')}}" alt="">
                                    <h3>10+</h3>
                                    <p>Countries </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/ind.png')}}" alt="">
                                    <h3>40+</h3>
                                    <p>Industry we serve </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/skill.jpeg')}}" alt="" style="width:70px;">
                                    <h3>50+</h3>
                                    <p>Total Emplopyee </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="about-box-item">
                                    <img src="{{ asset('public/frontant/images/succ.png')}}" alt="">
                                    <h3>100%</h3>
                                    <p>Success Rate </p>
                                </div>
                            </div>
                            <div class="line-desing">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- section end -->

@include('frontant_with_extra_path.layouts.partials.work')

<!-- Testimunials -->
<!-- ================ -->
@if($testimunials->isNotEmpty())
<div class="section clearfix client-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pb-25px">
                <!-- {{-- <h2 class="title text-center text-Uppercase animate-charcter">CLIENTS FEEDBACK</h2> --}} -->
                <h2 class="text-center"><span class="bottom-line" style="color: #fff">CLIENTS FEEDBACK</span></h2>
            </div>
        </div>
    </div>
    <div class="owl-carousel content-slider">
        @foreach($testimunials as $value)
        <div class="testimonial-item">

            <img src="{{asset('public/backend/testimonial/'.$value->image)}}" alt="{{ $value->alt ?? 'IT Way BD' }}" class="img-circle fixed-dimention bordered">


            <p>{!!$value->message!!}</p>
            <div class="testimonial-info-1" style="color: #e84c3d"><b>- {{$value->customer->name ?? 'N/A'}}</b></div>

        </div>
        @endforeach
    </div>
</div>
@endif

@if($expertise->isNotEmpty())
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h2 class="page-title animate-charcter">Our Expertise</h2>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row grid-space-20">
                    @foreach ($expertise as $value )
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg team-member">
                            <div class="overlay-container">
                                <img src="{{asset('public/backend/Expertise/'.$value->image)}}" alt="{{ $value->alt ?? 'IT Way BD' }}">
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- main end -->

        </div>
    </div>
</section>
@endif
<!-- End Testimunials -->




<!-- section start -->
<!-- ================ -->
<div class="section parallax light-translucent-bg backgroundImg">
    <div class="container">
        <div class="call-to-action">
            <div class="row">
                <div class="col-md-12">
                    {{-- <h2 class="title text-center animate-charcter">Industry we Serve</h2> --}}
                    <h2 class="text-center"><span class="bottom-line">Respected Client</span></h2>
                </div>
                {{-- <div class="stats row grid-space-10">
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1">
                            <h2 class="title">Projects</h2>
                            <i class="fa fa-briefcase"></i>

                            <div class="achivement-extra-style">
                                <span class="stat-num" data-to="{{$companydetails->project_done}}"
                data-speed="3000">0</span>+
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="box-style-1">
            <h2 class="title">Clients</h2>
            <i class="fa fa-users"></i>

            <div class="achivement-extra-style">
                <span class="stat-num" data-to="{{$companydetails->total_clients}}" data-speed="3000">0</span>+
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="box-style-1">
            <h2 class="title" style="font-size: 24px;dispaly:none">Running Project</h2>
            <i class="fa fa-gear"></i>
            <div class="achivement-extra-style">
                <span class="stat-num" data-to="{{$companydetails->running_project}}" data-speed="3000">0</span>+
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="box-style-1">
            <h2 class="title">Success Rate</h2>
            <i class="fa fa-check-square-o"></i>
            <div class="achivement-extra-style">
                <span class="stat-num" data-to="{{$companydetails->success_rate}}" data-speed="3000">0
                </span>%
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/public.png')}}" alt="">
            <h5 class="mt-1">Public Sector</h5>

        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/fin.png')}}" alt="">
            <h5 class="mt-1">Fin Tech</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/rmg.jpg')}}" alt="">
            <h5 class="mt-1">Rmg</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/manu.png')}}" alt="">
            <h5 class="mt-1">Manufacturing</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/trade.png')}}" alt="">
            <h5 class="mt-1">Trading</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/isp.png')}}" alt="">
            <h5 class="mt-1">ISP</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/avi.png')}}" alt="">
            <h5 class="mt-1">Aviation</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/consul.png')}}" alt="">
            <h5 class="mt-1">Consulting</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/hospital.png')}}" alt="">
            <h5 class="mt-1">Healthcare</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/ecom.png')}}" alt="">
            <h5 class="mt-1">E-commerce</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/education.png')}}" alt="">
            <h5 class="mt-1">Education</h5>
        </div>
    </div>
    <div class="col-md-2">
        <div class="achieve-item">
            <img src="{{ asset('public/frontant/images/more.png')}}" alt="">
            <h5 class="mt-1">Many More</h5>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- section end -->

<!-- section start -->
<!-- ================ -->
@if(!$ourclient->isEmpty())
<div class="section clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <h2>Our Respected Client</h2> --}}
                <h2 class="text-center"><span class="bottom-line">Respected Client</span></h2>
                {{-- <div class="separator-2"></div> --}}
                <div class="owl-carousel carousel">
                    @foreach($ourclient as $value)
                    <div class="image-box object-non-visible" data-animation-effect="fadeInLeft" data-effect-delay="300">
                        <div class="overlay-container">
                            <img src="{{asset('public/'.$value->logo)}}" alt="{{ $value->alt ?? 'IT Way BD' }}">
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endif
<!-- section end -->


@endsection