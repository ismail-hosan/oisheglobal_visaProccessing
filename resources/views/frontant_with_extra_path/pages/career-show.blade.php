@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{ $title ?? 'Career'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('main-content')

<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-10 col-md-offset-1">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">{{$career->title ?? ''}}</h1>
                <!-- page-title end -->

                <!-- blogpost start -->
                <article class="clearfix blogpost full">
                    <div class="blogpost-body">
                        <div>
                            {!! $career->description !!}
                        </div>
                        <strong>Publish Date: {{Carbon\Carbon::parse($career->published_at)->format('d-m-Y')}}</strong>
                        <br><strong>Deadline:
                            {{Carbon\Carbon::parse($career->application_deadline)->format('d-m-Y')}}</strong>
                    </div>
                </article>
                <!-- blogpost end -->


            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->

@endsection