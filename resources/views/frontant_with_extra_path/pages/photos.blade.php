@extends('frontant_with_extra_path.layouts.master')

@section('title')
Property
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a class="active">Image</a></li>
@endsection


@section('main-content')
  <style>
        h2.text-st {
            font-family: 'Arial', sans-serif;
            color: #2c3e50;
            text-align: center;
            font-size: 2.5em;

            letter-spacing: 0.1em;
            background: linear-gradient(90deg, #4ca1af, #c4e0e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 50px;
        }
    </style>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2 class="text-st">Oisheglobal</h2>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-4 mb-3" style="margin-bottom: 32px;">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-4by3" style="border:1px solid">
                        <img src="{{ asset('public/images/'.$image->image) }}" class="embed-responsive-item img-fluid" alt="{{ $image->title }}">
                    </div>
                     <h6 class="card-title text-center"  style="background: #4D50A1; color: white; padding: 11px;     margin-top: 3px;">{{ $image->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
@endsection