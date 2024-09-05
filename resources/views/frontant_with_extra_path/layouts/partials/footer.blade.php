<footer id="footer">
    <!-- .footer start -->
    <!-- ================ -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="logo-footer">
                                    @php
                                    $url = $company->logo ?? 'itwaybd-h.png';
                                    $path = asset("public/backend/logo/$url");
                                    @endphp
                                 
                                    <a href="{{'/'}}">
                                        <img style="max-width:200px;" src="{{$path}}"
                                            alt="{{$company->alt ?? 'N/A'}}">
                                    </a>
                                </div>
                                <ul class="social-links circle">


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
                                 
                            </div>

                            <div class="col-sm-6">
                                <h3>QUICK CONTACT</h3>
                                <ul class="list-icons">
                                    <li><i class="fa fa-phone pr-10"></i>{{$company->sale_phone}} </li>
                                    <li><i class="fa fa-phone pr-10"></i>{{$company->phone}}</li>
                                    <li><i class="fa fa-envelope-o pr-10"></i>{{$company->email}}</li>
                                    <li><i class="fa fa-map-marker pr-10"></i>{{$company->address}}</li>
                                    @if ($company->branch_address_1)
                                    <li style="font-weight: bold">Australia Office :</li>
                                    <li><i class="fa fa-home pr-10"></i>{{$company->branch_address_1}}</li>
                                    @endif
                                    @if ($company->branch_address_2)
                                    <li style="font-weight: bold">New Zealand Office :</li>
                                    <li><i class="fa fa-home pr-10"></i>{{$company->branch_address_2}}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-bottom hidden-lg hidden-xs"></div>
                <div class="col-sm-6 col-md-2">
                    <div class="footer-content">
                        <h3>QUICK LINK</h3>
                        <nav>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{'/'}}">Home</a></li>
                                <li><a href="{{route('menu.blog')}}">Blog</a></li>
                                <li><a href="{{route('menu.privacy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('menu.aboutus')}}">About</a></li>
                                <li><a href="{{route('contact.us')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-md-offset-1">
                    <div class="footer-content">
                  

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.0696838384824!2d90.41373547410147!3d23.78053278762124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c79c1e7f822f%3A0x6c343f84ca86b6c9!2sNavana%20Tower%2C%2045%20Gulshan%20Ave%2C%20Dhaka%201212!5e0!3m2!1sen!2sbd!4v1721028321985!5m2!1sen!2sbd" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="space-bottom hidden-lg hidden-xs"></div>
        </div>
    </div>
    <!-- .footer end -->

    <!-- .subfooter start -->
    <!-- ================ -->
    <div class="subfooter">
        <div class="container">
            <p>Copyright © 2024 
                @if($company->website)
                    <a target="_blank" href="{{ $company->website }}">{{ $company->company_name }}</a>
                @endif
                . All Rights Reserved By oishiglobal | <a href="https://www.itwaybd.com" target="_blank" rel="noopener noreferrer">Design and Development by <strong>ITWAYBD</strong></a>
            </p>
        </div>
    </div>
    <!-- .subfooter end -->
</footer>