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
        height: 150px;
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

    .tab-content:after {
        display: none;
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
        transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
        background-image: url('public/frontant/images/cltech2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        overflow: hidden;
        width: 100%;
        opacity: 2.0;
        height: 100%;
    }


    @media (max-width: 767px) {
        .realstate {

            font-size: 11px;


        }
    }
    
      .overlayss {
        padding: 90px;
    }
    .h2-xs
    {
        font-size: 50px;
    }
   

    @media (max-width: 767px) {
        .overlayss {
            padding: 20px;
        }
        .h2-xs
        {
            font-size: 26px;
        }
    }
</style>
<!-- section start -->
<!-- ================ -->
<div class="section clearfix">
    <!--<h1 class="d-none">Best website and top software development company in Dhaka Bangladesh</h1>-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container text-center">
                    <br>
                    <hr style="border-top: 1px solid #010101;">
                    <div class="blox_hr_txt"><span class="uc_style_blox_line_text_divider_elementor_text" style="color:#012E58;">About Us</span></div>
                    <!-- <span style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff;">Choose Us ?</span></h2> -->
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-6">
                        <!--<h2 class="title" style="margin-right: 10px;font-size:21px;">{{$aboutus->title}}</h2>-->
                        <div class="row">
                            <div class="col-md-12 about-section-text">

                                <p style="font-size:17px !important;">{!! \Illuminate\Support\str::limit(strip_tags($aboutus->description), 530) !!}</p>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="r-btn">
                                <a href="{{route('menu.aboutus')}}" class="btn btn-white">Explore About Us</a>
                            </div>
                        </div>
                        <div class="space hidden-md hidden-lg"></div>
                    </div>
                    <div class="col-md-6 about-section-img">
                        <img class="img" src="{{ asset('public/backend/aboutus/'.$aboutus->image) }}" alt="{{$aboutus->alt}}" style="border-radius:16px;">

                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- section end -->




@include('frontant_with_extra_path.layouts.partials.whychooseus')

@include('frontant_with_extra_path.layouts.partials.work')

<div class="container-fluid backgrounds highlights ">
    <div class="overlayss" style="background-color: rgb(56 0 133 / 50%);">
        <div class="row justify-content-center text-center">
        <div class="wpb_wrapper " style="box-sizing: border-box;">
        <div class="text-center" style="padding-right: 20px;padding-left: 20px;"> 
                     
            <h2 class="white-color h2-xs" style="font-family:Adamina;color:white">Top Rated Visa Immigration Consultant  in Bangladesh Equipped with foreign registered foreign lawyers</h2>
            <p class="Default p-lg">Equipped with foreign registered foreign lawyers</p>            
            <div class="stores-badge mt-30">
                <a target="_self" href="#" title="FREE ASSESSMENT" class="btn btn-success btn-lg primary-hover store btn-type-dark"><span>FREE ASSESSMENT</span></a>
                
            </div>      
        </div><div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div></div>
        </div>

    </div>
</div>

<!-- section start -->
<br>
<style>
    .overlay-container {
        position: relative;
        width: 100%;
    }

    .title-overlay {
        position: absolute;
        bottom: 0%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        width: 100%;
        padding: 10px 20px;
        background: rgba(0 0 0 / 60%);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.4);
    }

    .title-text {
        color: #fff;
        font-size: 18px;
    }
    .blox_hr_txt {
      display: inline-block;
      position: relative;
      margin: 0;
      padding: 5px 10px;
      margin: 0px 180px;
      border: 1px solid #000000;
      transform: translateY(-95%);
      color: #B5B4B4;
      text-align: center;
      background-color: #fff;
    }
</style>

@if($visaprocessings->isNotEmpty())
<div class="section clearfix" style="margin-top: 10px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container text-center">
                    <hr style="border-top: 1px solid #010101;">
                    <div class="blox_hr_txt"><span class="uc_style_blox_line_text_divider_elementor_text" style="color:#012E58;">Our Client</span></div>
                </div><br>
                <div class="row owl-carousel carousel-autoplays">
                    @foreach($visaprocessings as $visaprocessing)
                    <a href="{{Route('visaprocessing.show',$visaprocessing->slug)}}" class="col-md-12" style="width: 100%;">
                        <div class="card text-center" style="width: 100%;">
                            <div class="overlay-container">
                                <img src="{{asset('public/'.$visaprocessing->image)}}" alt="{{ $visaprocessing->name ?? 'oishiglobal' }}" style="height:202px;width: 100%;">
                                <div class="title-overlay">
                                    <span class="title-text">{{ $visaprocessing->name ?? 'Your Title Here' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- End VisaProcessing -->


@include('frontant_with_extra_path.layouts.partials.secondslider')

<style>
    .min-hight {
        min-height: 150px;
        margin-top: 20px;
        text-align: center
    }

    .bottom-btn {
        max-width: 150px;
        margin: 0 auto;
    }

    .card {
        position: relative;
        overflow: hidden;
    }
    .ditalis {
        text-align: center;
        padding: 26px;
        margin-top: 42px;
    }
</style>

<!-- section start -->
<!-- ================ -->
<div class="section clearfix" style="margin-top: 10px;">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container text-center">
                    <hr style="border-top: 1px solid #010101;">
                    <div class="blox_hr_txt"><span class="uc_style_blox_line_text_divider_elementor_text" style="color:#012E58;">Import</span></div>
                    <div class="blox_hr_txt"><span class="uc_style_blox_line_text_divider_elementor_text" style="color:#012E58;">Export</span></div>
                    <!-- <span style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff;">Choose Us ?</span></h2> -->
                </div><br>
                <div class="col-md-6 col-sm-12">
                    <div class="row owl-carousel carousel-autoplay">
                        @foreach($imports as $import)
                        <div class="col-md-12 col-sm-6">
                            <div class="card text-center" style="width: 100%;">
                                <div class="card-img-top">
                                    <img src="{{ asset('public/'.$import->image) }}" alt="Import Image" style="height: 168px;width:100%;border: 1px solid black;border-radius: 8px;">
                                </div>
                                <div class="card-body" style="padding:5px">
                                    <h5 class="card-title text-center" style="background: green;padding: 5px;border-radius: 15px;color: white;">{{ $import->title }}</h5>
                                    <p class="card-text">{!!$import->short_desc!!}</p>
                                    <a href="#" class="btn btn-danger">Learn More..</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row owl-carousel carousel-autoplay">
                        @foreach($exports as $export)
                        <div class="col-md-12 col-sm-6">
                            <div class="card text-center" style="width: 100%;">
                                <div class="card-img-top">
                                    <img src="{{ asset('public/'.$export->image) }}" alt="Export Image" style="height: 168px;width:100%">
                                </div>
                                <div class="card-body" style="padding:5px">
                                    <h5 class="card-title text-center">{!! $export->title !!}</h5>
                                    <p class="card-text">{!!$export->short_desc!!}</p>
                                    <a href="#" class="btn btn-danger">Learn More..</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section end -->


<script src="script.js"></script>


@endsection