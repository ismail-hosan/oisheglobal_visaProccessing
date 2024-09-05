@extends('frontant_with_extra_path.layouts.master')

@section('title')
Overview
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection


@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li><a class="active">Overview</a></li>
@endsection
<style>
    .overlay-container img{
        height: 60px;
    }
   

    
    .article {
    margin-top: 60px;
    margin-left: 50px;
    }
</style>

@section('main-content')

<!-- section start -->
<!-- ================ -->


<div class="section clearfix">
    <div class="container sec-padding">
        <div class="row">
             <div class="col-lg-4">
                <img src="{{ asset('/public/frontant/images/vision.png')}}" alt="" style="border-radius: 20px;">
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="overview-item">
                    <div class="article">
                        <h3>VISION</h3>
                        <p>To be the builder of choice by potential clients for reliable execution</p>    
                    </div>    
                </div>
            </div>
           
        </div>
        <div class="row" style="margin-top: 26px;background-color: #E4FFFD;">
            <div class="col-lg-7 col-sm-12">
                <div class="overview-item">
                    <div class="article">
                        <h3>MISSION</h3>
                                                    

                        <ul>
                            <li><p>To establish ourselves as a reliable real estate development company that delivers exceptional value to our clients.</p></li>
                        </ul>
                        <ul>
                            <li><p>To create living spaces that meet the unique needs and aspirations of our clients.</p></li>
                        </ul>
                        <ul>
                            <li><p>To continuously innovate and adopt the latest technology and construction methods to enhance the quality and efficiency of our projects.</p></li>
                        </ul>
                        <ul>
                            <li><p>To foster a culture of transparency, accountability, and open communication with our clients, partners, and stakeholders.</p></li>
                        </ul>
                        <ul>
                            <li><p>To provide our employees with a safe, fulfilling, and challenging work environment that promotes personal and professional growth.</p></li>
                        </ul>
                        <ul>
                            <li><p>To contribute to the growth and development of our communities by creating job opportunities and supporting local initiatives.</p></li>
                        </ul>
                        <ul>
                            <li><p>To continuously learn, adapt, and evolve to stay ahead of the curve and deliver exceptional value to our clients and stakeholders.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ asset('/public/frontant/images/mission.jpg')}}" alt="" style="border-radius: 20px;margin-top: 88px;">
            </div>
        </div>  
        <div class="row" style="margin-top: 26px;">
             <div class="col-lg-6 col-sm-12">
                <img src="{{ asset('/public/frontant/images/value.jpg')}}" alt="" style="border-radius: 20px;margin-top: 88px;">
            </div>
            <div class="col-lg-6">
                <div class="overview-item">
                    <div class="article">
                        <h3>VALUES</h3>
                        <p><b>Customer Satisfaction:</b> At bel, customer satisfaction is not just a buzzword – it’s at the heart of everything we do. We believe that our clients are the lifeblood of our business, and their satisfaction is a testament to the quality of our work and the strength of our relationships.</p>
                        <p><b>Quality:</b> We believe that quality is not just a goal – it’s a non-negotiable standard that guides every aspect of our work. We understand that our clients are making a significant investment in their homes, and we are committed to delivering a level of quality that exceeds their expectations.
                        </p>
                        <p><b>Timely Handover:</b> We believe that timely handover is not just about meeting deadlines but also about honoring our commitments to our clients, maintaining their trust, and creating a positive reputation for our company. We understand that delays can cause inconvenience, frustration, and financial losses to our clients, and we do everything in our power to avoid them.</p>
                    </div>
                </div>
            </div>
        </div>  
    </div>
       
</div>


<!-- section end -->

@endsection