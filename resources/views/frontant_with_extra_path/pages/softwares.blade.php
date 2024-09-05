@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{$data->title ?? 'Services'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


 @section('page-intro')
<li><a href="{{route('menu.aboutus')}}">Home</a></li>
<li class="active">{{$data->title ?? 'Services'}}</li>
@endsection 


@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">{!! $data->title ?? 'Services' !!}</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->

                <!-- portfolio items start -->
                <div class="row">

                    <div
                        class="{{ ($data->tecnology == null && $data->video_link == null) ? 'col-md-12' : 'col-md-12'}}">
                        @if($data->gallaries->isNotEmpty())
                        <div>
                            <img style="max-width:100%;" src="{{asset('public/backend/products/' . $data->gallaries->first()->image)}}" alt="{{$data->alt}}" title="{{$data->alt}}">
                        </div>
                        @endif
                        {!! $data->description !!}
                    </div>
                    {{-- @if ( $data->tecnology || $data->video_link)
                    <div class="col-md-4">

                        @if ($data->tecnology)
                        <div class="development_technology">

                            {!! $data->tecnology !!}
                        </div>
                        @endif
                        @if ($data->video_link)
                        <div>
                            {!! $data->video_link !!}
                        </div>
                        @endif

                    </div>

                    @endif --}}
                </div>

                <!-- portfolio items end -->
            </div>
        </div>
        <br><br>

        @if($data->modules->isNotEmpty())
        <div class="row">
            <div class="main col-md-12">
                <div class="software_module">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="seciton_title">
                                <h4> Modules </h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        @foreach($data->modules as $value)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <ul>
                                <li> <i class="fa fa-check-square-o"></i> <span>{{$value->name}}</span></li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($data->gallaries->isNotEmpty())
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="seciton_title">
                                <h4> Gallaries </h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        @foreach($data->gallaries as $value)
                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3">
                            <img src="{{asset('public/backend/products/' . $value->image)}}" style="margin:0 0 20px 0;border:1px solid #000" alt="{{$data->alt}}" title="{{$data->alt}}">
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
        @endif



        @if($data->packages->isNotEmpty())
        <div class="row">
            <div class="pricing-tables stripped object-non-visible" data-animation-effect="fadeInUpSmall">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="seciton_title">
                            <h3><b>Our Package</b></h3>
                            <hr>
                        </div>
                    </div>

                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                    @endif
                    @php

                    @endphp
                    <input type="hidden" value="{{ $data->title }}" id="serviceTitle">
                    @foreach($data->packages as $value)
                    <!-- pricing table start -->
                    <div class="col-sm-3 col-md-3 ">
                        <div class="plan stripped package">
                            <div class="header">
                                <h3>{{$value->name}}</h3>

                            </div>
                            @if ($value->onetime_amount)
                            <div class="default-bg">
                                <h4>{{$value->onetime_amount}}</h4>
                            </div>
                            @endif
                            @if ($value->monthly_amount)
                            <div class="header">
                                <h4>{{$value->monthly_amount}}</h4>
                            </div>

                            @endif
                            @foreach($value->details as $details)
                            <ul>
                                <li>{{$details->name}}</li>
                            </ul>

                            @endforeach
                            <ul>
                                <li>
                                    <button type="button" class="btn btn-default"
                                        onclick="getData('<?php echo $value->name?>')" data-toggle="modal"
                                        data-target="#myModal">Order Now</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- pricing table end -->
                    @endforeach

                </div>
            </div>
        </div>
        @endif

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <b> Order Now<b>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="modal-body">
                        <span class="titleName"></span> >
                        <span class="ptitle"></span>
                        <form action="{{route('orderNow')}}" method="POST">
                            @csrf
                            <input type="hidden" name="packageName" id="showpackagetitle">
                            <input type="hidden" name="titleHere" id="titleHere">

                            <div class="form-group">
                                <label for="email">Name * :</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Phone * :</label>
                                <input type="text" name="phone" class="form-control" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Email :</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class=" form-group">
                                <label for="pwd">Requirement * :</label>
                                <textarea type="text" name="requirement" class="form-control"></textarea>
                            </div>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>

            </div>
        </div>
</section>

<script>
    function getData(ptitle) {
        let title = $("#serviceTitle").val();
        $("#titleHere").val(title);
        $("#showpackagetitle").val(ptitle);
        $(".titleName").html(title);
        $(".ptitle").html(ptitle);
    }
</script>
@endsection