@extends('frontant_with_extra_path.layouts.master')


@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('title')
Our Client
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li class="active">Our Client</li>
@endsection


@section('main-content')

<style>
    .overlay-container img {
        width: 100%;
        opacity: 1;
        animation: bounce 1s infinite alternate, zoom 1s infinite alternate;
        transition: opacity 0.3s ease-in-out;
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


    .overlay-container:hover img {
        opacity: 0.7;
        animation: bounce 2s infinite alternate, zoom 2s infinite alternate reverse;
    }
</style>

<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-8">
                <div class="row">
                    @foreach($ourclient as $value)
                    <div class="col-md-4 col-sm-12 isotope-item">
                        <div class="image-box">
                            <div class="overlay-container">
                                <img src="{{asset('public/'.$value->logo)}}" alt="{{ $value->alt ?? 'IT Way BD' }}" class="fade-in-out" style="height:202px;width: 100%;">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: blue;color:white;padding:150px">
                        Contact Us
                    </div>
                    <div class="panel-body">
                        <p><span class="glyphicon glyphicon-earphone"></span> +88-01945111444</p>
                        <p><span class="glyphicon glyphicon-envelope"></span> info@oisheglobal.com</p>
                        <p><span class="glyphicon glyphicon-map-marker"></span> Flat# 101, House# 14, Road# 06, Gulshan# 1, Dhaka, Bangladesh</p>

                        <a href="{{Route('view.useregister')}}" class="btn btn-success button">Online Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection