@extends('frontant_with_extra_path.layouts.master')

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection



@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">{{$client->name??"N/A"}}</h1>
                <div class="separator-2"></div>
                <hr>
                <!-- page-title end -->
                <div class="row">
                    <div class="{{$client->image ? 'col-md-6' : 'col-md-9'}}">
                        {!! $client->description !!}

                    </div>
                    <!-- sidebar start -->

                    @if($client->image)
                    <aside class="sidebar col-md-6">
                        <img class="img-responsive col-xs-12"
                            src="{{asset('public'. $client->image)}}" width="900px" height="auto"
                            alt="{{ $aboutpage->alt ?? 'gtech' }}">
                    </aside>
                    @endif
                    <!-- sidebar end -->
                </div>

            </div>
        </div>
    </div>
</section>


@endsection