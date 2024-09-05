@extends('frontant_with_extra_path.layouts.master')



@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">Home</a></li>
<li class="active">{{$visa->title ?? 'Services'}}</li>
@endsection


@section('main-content')
<style>
    .panel-heading {
        font-size: 16px;
        font-weight: bold;
    }

    .panel-body p {
        margin-bottom: 10px;
    }

    .banner {
        display: none;
    }

    @media (max-width: 767px) {
        .sakib {
            display: flex;
            flex-direction: column;
        }
    }

    .slider-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 2000px;
        border: none;
    }

    .slider-wrapper {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slider-item {
        flex: 0 0 100%;
    }

    .slider-item img {
        width: 100%;
        height: 200px;
    }


    @media (max-width: 767px) {
        .slider-item img {
            height: 180px;
        }
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .btn-block {
        border-radius: 4px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .title {
        position: absolute;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        font-size: 24px;
        padding: 16px 80px;
        color: white;
        background: rgb(0 0 0 / 33%);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.4);
    }

    .button {
        animation: bounce 1s infinite alternate, zoom 1s infinite alternate;
    }

    @keyframes bounce {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }


    @keyframes zoom {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.1);
        }
    }

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
        /* border-radius: 8px; */
    }

    .title-text {
        color: #fff;
        font-size: 18px;
    }
</style>


<!-- slideshow start -->
<div class="slider-container">
    <h1 class="title">{{$visa->name ?? 'visa processing'}}
        <div class="separator-2"></div>
    </h1>
    <div class="slider-wrapper">
        @if($topsliders->isEmpty())
        <div class="slider-item">
            <img src="{{ asset('public/frontant/images/defult.jpg') }}" alt="default slider">
        </div>
        @else
        @foreach ($topsliders as $slider)
        <div class="slider-item">
            <img src="{{ asset('public/' . $slider->image) }}" alt="{{ $slider->alt ?? 'slider' }}">
        </div>
        @endforeach
        @endif
    </div>
</div>
<!-- slideshow end -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentIndex = 0;
        var slides = document.querySelectorAll('.slider-item');
        var totalSlides = slides.length;

        function updateSlider() {
            var newTransformValue = -currentIndex * 100 + '%';
            document.querySelector('.slider-wrapper').style.transform = 'translateX(' + newTransformValue + ')';
            updatePagination();
        }

        function autoSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        }
        var intervalId = setInterval(autoSlide, 8000);
        document.querySelector('.slider-container').addEventListener('mouseout', function() {
            intervalId = setInterval(autoSlide, 8000);
        });

        // Initial setup
        updateSlider();
    });
</script>


<div class="container" style="margin-top: 50px;">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="{{ asset('public/'.$visa->image) }}" class="img-responsive" alt="UAE Flag" style="width: 100%;height: 300px;">
                </div>
            </div>
            <div class="panel panel-primary" style="border: none;">
                <div class="panel-heading" style="background-color: rgba(135 193 154 / 50%) !important;color:blue">
                    Ditails
                    <!-- Additional content here -->
                </div>
                <div class="panel-body">
                    {!!$visa->ditails ?? ''!!}
                </div>
            </div>
        </div>


        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{$visa->name ?? ''}} Visa from Bangladesh
                </div>
                <div class="panel-body" style="display: flex; justify-content: center;">
                    <div class="row owl-carousel carousel-process">
                        @if($visteds->isEmpty())
                        <img src="{{ asset('public/'.$visa->image) }}" class="img-responsive" alt="UAE Flag Small" style="width:100%">
                        @else
                        @foreach($visteds as $visit)
                        <img src="{{ asset('public/'.$visit->image) }}" class="img-responsive" alt="UAE Flag Small" style="width:100%">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Contact Us
                </div>
                <div class="panel-body">
                    <p><span class="glyphicon glyphicon-earphone"></span> +88-01945111444</p>
                    <p><span class="glyphicon glyphicon-envelope"></span> info@oisheglobal.com</p>
                    <p><span class="glyphicon glyphicon-map-marker"></span> Flat# 101, House# 14, Road# 06, Gulshan# 1, Dhaka, Bangladesh</p>

                    <a href="{{Route('view.useregister')}}" class="btn btn-success button">Online Apply</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    You May Also Like
                </div>

                <div class="panel-body">
                    @foreach($relateds as $related)
                    <a href="" class="col-md-12 col-sm-6" style="margin-bottom: 10px;">
                        <div class="card text-center" style="width: 100%;">
                            <div class="overlay-container">
                                <img src="{{ asset('public/'.$related->image) }}" class="img-responsive" alt="UAE Flag Small" style="width:100%">
                                <div class="title-overlay">
                                    <span class="title-text">{{$related->name??'name'}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach

                    <!-- <a href="#" class="btn btn-success button">Apply</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection