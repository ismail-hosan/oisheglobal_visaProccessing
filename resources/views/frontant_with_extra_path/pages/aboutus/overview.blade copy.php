@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
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
        height: 60px;
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
        <div class="row sec-padding">
            <div class="col-lg-3">
                <div class="overview-item">
                    <img src="{{ asset('/public/frontant/images/ms.png')}}" alt="">
                    <h3>OUR Mission</h3>
                    <p>Our mission is to achieve customer satisfaction. For that, we provide time tested, secure, reliable &
                        cost- effective
                        management level business solutions to our customers.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="overview-item">
                    <img src="{{ asset('/public/frontant/images/vs.png')}}" alt="">
                    <h3>Our Vision</h3>
                    <p>Our vision is to be trusted & respected everywhere as a leading software company & our industry to
                        delivering &
                        developing innovative solutions for our customers to improve their day to day business growth.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="overview-item">
                    <img src="{{ asset('/public/frontant/images/ql.png')}}" alt="">
                    <h3>Ensure Top Quality</h3>
                    <p>Quality is most important to IT WAY BD. IT WAY BD has emphasized on quality management practices from the
                        very
                        beginning, IT WAY BD practices world class quality management tools to ensure consistent quality of its
                        products.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="overview-item">
                    <img src="{{ asset('/public/frontant/images/str.png')}}" alt="">
                    <h3>Our Strength</h3>
                    <p>Experienced team of young energetic & senior professionals, whose dedication & creativity on various
                        projects improve
                        our company strength gradually.</p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 pb-25px">
                {{-- <h2 class="title text-center text-Uppercase animate-charcter">CLIENTS FEEDBACK</h2> --}}
                <h2 class="text-center"><span style="background: #10245a;color:#fff;border-radius:10px 0px;padding:0px 5px;font-size:32px;" >Work</span> <span
                        style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff; font-size:32px;">Technologies</span></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/react.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/php.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/java.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/mysql.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/python.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/js.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/laravel.png')}}" alt="react logo" style="width: 100px; height:60px;">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/bootstrap.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/angular.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/and.png')}}" alt="react logo" style="height: 60px;">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/ai.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/ps.png')}}" alt="react logo" width="100px">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/jq.png')}}" alt="react logo"
                        style="width: 100px; height:60px;">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/wordpress.png')}}" alt="react logo" width="100px">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/codeIg.png')}}" alt="react logo" style="height: 60px;">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="tech-item">
                    <img src="{{ asset('/public/frontant/images/cisco.png')}}" alt="react logo" style="height: 60px;">
                </div>
            </div>
            
        </div>
    </div>
   
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