@extends('frontant_with_extra_path.layouts.master')


@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


@section('title')
Visa Service in Bangladesh - Visa Agency
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li class="active">Our Client</li>
@endsection


@section('main-content')
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
        /* border-radius: 8px; */
    }

    .title-text {
        color: #fff;
        font-size: 18px;
    }
</style>

<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <div class="row">
                    @foreach($visaProcesing as $value)
                    <a href="{{Route('visaprocessing.show',$value->slug)}}" class="col-md-3 col-sm-12 isotope-item">
                        <div class="image-box">
                            <div class="overlay-container">
                                <img src="{{asset('public/'.$value->image)}}" alt="{{ $value->name ?? 'oishiglobal' }}" style="height:202px;width: 100%;">
                                <div class="title-overlay">
                                    <span class="title-text">{{ $value->name ?? 'Your Title Here' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- portfolio items end -->
            </div>
        </div>
    </div>
</section>
@endsection