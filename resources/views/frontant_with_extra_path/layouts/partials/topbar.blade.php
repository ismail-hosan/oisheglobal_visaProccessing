<div class="header-top topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-6">
                <!-- header-top-first start -->
                <!-- ================ -->
                <div class="header-top-second clearfix">
                    <ul class="social-links clearfix hidden-xs">


                        @if (isset($company->facebook) && $company->facebook)
                        <li class="facebook">
                            <a target="_blank" href="{{$company->facebook}}">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        @endif

                        @if (isset($company->linkedin) && $company->linkedin)
                        <li class="linkedin">
                            <a target="_blank" href="{{$company->linkedin}}">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        @endif
                        @if (isset($company->youtube) && $company->youtube)
                        <li class="youtube">
                            <a target="_blank" href="{{$company->youtube}}">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        @endif



                    </ul>
                    <div class="social-links hidden-lg hidden-md hidden-sm">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-share-alt"></i></button>
                            <ul class="dropdown-menu dropdown-animation">


                                @if (isset($company->facebook) && $company->facebook)
                                <li class="facebook">
                                    <a target="_blank" href="{{$company->facebook}}">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                @endif

                                @if (isset($company->linkedin) && $company->linkedin)
                                <li class="linkedin">
                                    <a target="_blank" href="{{$company->linkedin}}">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                @endif
                                @if (isset($company->youtube) && $company->youtube)
                                <li class="youtube">
                                    <a target="_blank" href="{{$company->youtube}}">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                @endif
                                @if (isset($company->instagram) && $company->instagram)
                                <li class="instagram">
                                    <a target="_blank" href="{{$company->instagram}}">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header-top-first end -->
            </div>
            <div class="col-md-10 col-xs-6">
                <!-- header-top-second start -->
                <!-- ================ -->
                <div id="header-top-first" class="clearfix">
                    <ul class="list-inline pull-right">
                        @if($company->sale_phone)
                        <li style="white-space:nowrap;"><i class="fa fa-phone pr-5 pl-10"></i> {{$company->sale_phone ?? ''}}</li>
                        @endif
                        <li style="white-space:nowrap;"><i class="fa fa-phone pr-5 pl-10"></i> {{$company->phone ?? ''}}</li>
                        <li class="hidden-sm hidden-xs"><i class="fa fa-map-marker pr-5 pl-10"></i>{{$company->address ?? ''}}</li>
                        <li class="hidden-sm hidden-xs"><a href="{{url('auth/login')}}" style="background:#EF622A; padding:10px 20px;color:#fff">Login</a></li>
                    </ul>
                </div>
                <!-- header-top-second end -->
            </div>
        </div>
    </div>
</div>