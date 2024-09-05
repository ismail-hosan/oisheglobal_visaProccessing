@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
Privacy Policy
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a class="active">Privacy Policy</a></li>
@endsection


@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                {!! $company->privacy_policy !!}
            </div>
        </div>
    </div>
</section>


@endsection