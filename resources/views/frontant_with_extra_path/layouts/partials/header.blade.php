<header class="header fixed clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="width:24%">
                <!-- header-left start -->
                <!-- ================ -->
                <div class="header-left clearfix">
                    <!-- logo -->
                    <div class="logo">
                        @php
                        $url = $company->logo ?? 'itwaybd-h.png';
                        $path = asset("public/backend/logo/$url");
                        @endphp
                        <a href="{{'/'}}"><img class="max-width-200" src="{{$path}}" alt="{{$company->alt ?? 'N/A'}}"></a>
                    </div>
                    <!-- name-and-slogan -->
                </div>
                <!-- header-left end -->
            </div>
            <div class="col-md-9">

                <!-- header-right start -->
                <!-- ================ -->
                <div class="header-right clearfix">
                    <!-- main-navigation start -->
                    <!-- ================ -->
                    <div class="main-navigation animated">

                        <!-- navbar start -->
                        <!-- ================ -->
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="container-fluid">
                                <!-- Toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        {{-- @dd(Request::routeIs('menu.aboutus')) --}}
                                        <li class="{{ Request::routeIs('frontend.index') ? 'active' : '' }}">
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false">About us</a>

                                            <ul class=" dropdown-menu">
                                                <li class="{{ Request::routeIs('menu.aboutus') ? 'active' : '' }}">
                                                    <a href="{{Route('menu.aboutus')}}">Company Overview</a>
                                                </li>
                                                <!-- <li class="{{ Request::routeIs('menu.aboutus.directorMesssge') ? 'active' : '' }}">
                                                    <a href="{{Route('menu.aboutus.directorMesssge')}}">Message From Chairman</a>
                                                </li> -->
                                                <li class="{{ Request::routeIs('menu.aboutus.ourteam') ? 'active' : '' }}">
                                                    <a href="{{Route('menu.aboutus.ourteam')}}">Management Team</a>
                                                </li>
                                                <li class="{{ Request::routeIs('menu.aboutus.mission') ? 'active' : '' }}">
                                                    <a href="{{Route('menu.aboutus.mission')}}">Vision, Mission & Values</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="{{ (isset($service_menu) && $service_menu->isNotEmpty()) ? 'dropdown' : ''}} {{ Request::routeIs(['pages.services','pages.services.*']) ? 'active' : '' }}">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Services</a>

                                            @if (isset($service_menu) && $service_menu->isNotEmpty())
                                            <ul class="dropdown-menu">
                                                @foreach($service_menu as $key => $ser_cat)
                                                <li class="{{count($ser_cat->products) > 0 ? 'dropdown':''}} ">
                                                    {{-- category link --}}
                                                    <a href="{{ $ser_cat->url ? $ser_cat->url :route('pages.services',['slug'=>$ser_cat->slug]) }}" class="dropdown-toggle" data-toggle="{{count($ser_cat->products) > 0 ? 'dropdown':''}}" aria-expanded="false">{{$ser_cat->title}}</a>
                                                    @if(count($ser_cat->products) > 0)
                                                    <ul class="dropdown-menu">
                                                        @foreach($ser_cat->products as $child_service)

                                                        <li>
                                                            <a href="{{route('pages.product',['slug' => $child_service->slug])}}">{{ strip_tags($child_service->title) }}</a>
                                                        </li>

                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>

                                        <!-- <li class="{{ (isset($products_menu) && $products_menu->isNotEmpty()) ? 'dropdown' : ''}} {{ Request::routeIs(['pages.product','pages.product.*']) ? 'active' : '' }}">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Products</a>
                                            @if (isset($products_menu) && $products_menu->isNotEmpty())
                                            <ul class="dropdown-menu">
                                                @foreach($products_menu as $item)
                                                @continue($item->service_id)
                                                @if($item->id == 24)
                                                <li>
                                                    <a href="{{ route('top_ten_products') }}" class="dropdown-toggle" style="display: none;">{{ strip_tags($item->title) }}</a>
                                                </li>
                                                @elseif($item->id != 25)
                                                <li>
                                                    <a href="{{ route('pages.product',['slug'=>$item->slug]) }}" class="dropdown-toggle">{{ strip_tags($item->title) }}</a>
                                                </li>
                                                @endif


                                                @endforeach
                                            </ul>
                                            @endif
                                        </li> -->



                                        <!-- <li class="{{ Request::routeIs('blog') ? 'active' : '' }}">
                                            <a href="{{route('menu.blog')}}">Blog</a>
                                        </li> -->

                                        

                                        <li class="{{ Request::routeIs('menu.visaService') ? 'active' : '' }}">
                                            <a href="{{route('menu.visaService')}}">Visa Service</a>
                                        </li>

                                        <li class="{{ Request::routeIs('menu.aboutus.ourclient') ? 'active' : '' }}">
                                            <a href="{{route('menu.aboutus.ourclient')}}">Client</a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Gallery</a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{Route('view.photos')}}" class="dropdown-toggle">Photos</a>
                                                </li>

                                                <li>
                                                    <a href="{{Route('view.videos')}}" class="dropdown-toggle">Videos</a>
                                                </li>

                                            </ul>

                                        </li>

                                        <li class="{{ Request::routeIs('contact.us') ? 'active' : '' }}">
                                            <a href="{{route('contact.us')}}">Contact</a>
                                        </li>

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Become Member</a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{Route('view.baranchRegister')}}" class="dropdown-toggle">Agent</a>
                                                </li>

                                                <li>
                                                    <a href="{{Route('view.useregister')}}" class="dropdown-toggle">Customer</a>
                                                </li>

                                            </ul>

                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!-- navbar end -->

                    </div>
                    <!-- main-navigation end -->

                </div>
                <!-- header-right end -->
            </div>
        </div>
    </div>
</header>