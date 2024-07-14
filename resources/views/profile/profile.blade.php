@extends('mainwebsite.layout.main')

@section('allcontent')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-10">
            <div class="container">
                <div class="section deals-header-area ptb-30">
                    <div class="row row-tb-20">
                        <div class="col-xs-12 col-md-4 col-lg-3">
                            <aside>
                                <ul class="nav-coupon-category panel">
                                    <li><a href="#"><i class="fa fa-cutlery"></i>User Information</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-calendar"></i>Withdraw Money</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-female"></i>Coupon Card Activity</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-bolt"></i>All Notification</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-image"></i>Your Game Activity</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-umbrella"></i>Update Profile</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Delete Profile</span></a>
                                    </li>
                                    <li>
                                        <a class="font-14" href="#"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-md-8 col-lg-9">
                            <div class="header-deals-slider owl-slider" data-loop="true" data-autoplay="true"
                                data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true"
                                data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true"
                                data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1"
                                data-lg-nav="true">
                                <!-- Content for the slider can go here -->
                            </div>

                            <!-- New box section -->
                            <div class="page-content page-container" id="page-content">
                                <div class="padding">
                                    <div class="row container d-flex justify-content-center">
                                        <div class="col-xl-6 col-md-8">
                                            <div class="card user-card-full">
                                                <div class="row m-l-0 m-r-0">
                                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                                        <div class="card-block text-center text-white">
                                                            <div class="m-b-25">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/user.png"
                                                                    class="img-radius" alt="User-Profile-Image">
                                                            </div>
                                                            <h6 class="f-w-600">{{ ucwords($user->name) }}</h6>
                                                            {{-- <p>Web Designer</p> --}}
                                                            <i
                                                                class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="card-block">
                                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600">Email</p>
                                                                    <h6 class="text-muted f-w-400">{{ $user->email }}</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600">Phone</p>
                                                                    <h6 class="text-muted f-w-400">98979989898</h6>
                                                                </div>
                                                            </div>
                                                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Activity</h6>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600">Recent</p>
                                                                    <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                    <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                                                </div>
                                                            </div>
                                                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                <li><a href="#!" data-toggle="tooltip"
                                                                        data-placement="bottom" title=""
                                                                        data-original-title="facebook" data-abc="true"><i
                                                                            class="mdi mdi-facebook feather icon-facebook facebook"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li><a href="#!" data-toggle="tooltip"
                                                                        data-placement="bottom" title=""
                                                                        data-original-title="twitter" data-abc="true"><i
                                                                            class="mdi mdi-twitter feather icon-twitter twitter"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li><a href="#!" data-toggle="tooltip"
                                                                        data-placement="bottom" title=""
                                                                        data-original-title="instagram" data-abc="true"><i
                                                                            class="mdi mdi-instagram feather icon-instagram instagram"
                                                                            aria-hidden="true"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                body {
                                    background-color: #f9f9fa
                                }

                                .padding {
                                    padding: 3rem !important
                                }

                                .user-card-full {
                                    overflow: hidden;
                                }

                                .card {
                                    border-radius: 5px;
                                    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
                                    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
                                    border: none;
                                    margin-bottom: 30px;
                                }

                                .m-r-0 {
                                    margin-right: 0px;
                                }

                                .m-l-0 {
                                    margin-left: 0px;
                                }

                                .user-card-full .user-profile {
                                    border-radius: 5px 0 0 5px;
                                }

                                .bg-c-lite-green {
                                    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
                                    background: linear-gradient(to right, #ee5a6f, #f29263);
                                }

                                .user-profile {
                                    padding: 70px 0;
                                }

                                .card-block {
                                    padding: 1.25rem;
                                }

                                .m-b-25 {
                                    margin-bottom: 25px;
                                }

                                .img-radius {
                                    border-radius: 5px;
                                }



                                h6 {
                                    font-size: 14px;
                                }

                                .card .card-block p {
                                    line-height: 25px;
                                }

                                @media only screen and (min-width: 1400px) {
                                    p {
                                        font-size: 14px;
                                    }
                                }

                                .card-block {
                                    padding: 1.25rem;
                                }

                                .b-b-default {
                                    border-bottom: 1px solid #e0e0e0;
                                }

                                .m-b-20 {
                                    margin-bottom: 20px;
                                }

                                .p-b-5 {
                                    padding-bottom: 5px !important;
                                }

                                .card .card-block p {
                                    line-height: 25px;
                                }

                                .m-b-10 {
                                    margin-bottom: 10px;
                                }

                                .text-muted {
                                    color: #919aa3 !important;
                                }

                                .b-b-default {
                                    border-bottom: 1px solid #e0e0e0;
                                }

                                .f-w-600 {
                                    font-weight: 600;
                                }

                                .m-b-20 {
                                    margin-bottom: 20px;
                                }

                                .m-t-40 {
                                    margin-top: 20px;
                                }

                                .p-b-5 {
                                    padding-bottom: 5px !important;
                                }

                                .m-b-10 {
                                    margin-bottom: 10px;
                                }

                                .m-t-40 {
                                    margin-top: 20px;
                                }

                                .user-card-full .social-link li {
                                    display: inline-block;
                                }

                                .user-card-full .social-link li a {
                                    font-size: 20px;
                                    margin: 0 10px 0 0;
                                    -webkit-transition: all 0.3s ease-in-out;
                                    transition: all 0.3s ease-in-out;
                                }
                            </style>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
