@extends('frontant_with_extra_path.layouts.master')


@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li class="active">Our Client</li>
@endsection


@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Message Form Managing Director</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->

                <!-- portfolio items start -->
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <!-- <h3>Dear Valued Customers</h3> -->
                        <p style="margin-left: auto; margin-right: auto; text-align: justify;">
                            Mr. Mostafa Al Mahmud, chairperson of the Company has completed his Master’s degree from University
                            of Dhaka. He is resourceful and experienced businessman, especially in the overseas business and
                            international trade. He is involved in various sectors such as garments industry, food industry, agro
                            industry, etc.
                            He is familiar as one of the leading entrepreneur and business personality of the country. Have been
                            involved in various businesses arena successfully more than two decades in home and overseas as a
                            business leader. Being succeeded in new ventures over time the worthy areas of my investment and
                            business has grown up in Solar and Renewable Energy, Dredging Industry, Ready Made Garments Industry,
                            Food industry, Logistics and Infrastructural development sectors avoiding such procrastination. Most
                            importantly, he is the pioneer of “Solar and Renewable Energy” in my homeland besides has a
                            determination to continue this effort to contribute more in progress and development context for
                            Bangladesh respectively.
                            He is the founder General Secretary of the only recognized business association for renewable energy
                            business in the country. Presently, he is bearing the post of Vice President of the Bangladesh Solar and
                            Renewable Energy Association (BSREA). He has been visited more than 30 countries around the world. He
                            has attended numerous types of business seminar, symposium, and trade fair all over the world.
                            <br><br>Sincerely,<br><br>
                            <b>Honorable Chairman Mr. Mostafa Al Mahmud</b>
                        </p>

                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('public/frontant/images/director.jpg')}}" alt="">
                    </div>
                </div>
                <!-- portfolio items end -->
            </div>
        </div>
    </div>
</section>
@endsection