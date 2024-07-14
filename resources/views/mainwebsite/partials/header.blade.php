<header id="mainHeader" class="main-header">

    <!-- Top Bar -->
    <div class="top-bar bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 is-hidden-sm-down">
                    <ul class="nav-top nav-top-left list-inline t-left">
                        <li><a href="#"><i class="fa fa-question-circle"></i>Discounts Guide</a>
                        </li>
                        <li><a href="#"><i class="fa fa-support"></i>Customer Assistance</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul class="nav-top nav-top-right list-inline t-xs-center t-md-right">
                        <li>
                            <a href="#"><i class="fa fa-flag-en"></i>English <i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-flag-en"></i>English</a>
                                </li>
                                <li><a href="#"><i class="fa fa-flag-ar"></i>العربية</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-inr"></i>INR <i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li><a href="#">USD - US Dollar</a>
                                </li>
                                <li><a href="#">INR - Rupee</a>
                                </li>
                                {{-- <li><a href="#">CNY - Chinese Yuan</a>
                                </li>
                                <li><a href="#">RUB - Russian Ruble</a>
                                </li> --}}
                            </ul>
                        </li>
                        @if(Auth::user())
                             <li class="nav-item dropdown">
        <a href="#" ><i class="fa fa-user"></i>{{Auth::user()->name}}<i class="fa fa-caret-down"></i></a>
        <ul class="user_profile">
            <li><a href="{{ route('profiles') }}">Profile</a>
                                </li>
                                <li><form method="POST" action="{{ route('logout') }}">
            @csrf
             <button type="submit" class="btn btn-danger btn-sm">Log Out</button>
            </form>
                                </li>
        </ul>
      </li>

                        @else
                            <li><a href="{{route("login")}}"><i class="fa fa-lock"></i>Sign In</a>
                            </li>
                            <li><a href="{{route("register")}}"><i class="fa fa-user"></i>Sign Up</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <!-- Header Header -->
    <div class="header-header bg-white">
        <div class="container">
            <div class="row row-rl-0 row-tb-20 row-md-cell">
                <div class="brand col-md-3 t-xs-center t-md-left valign-middle">
                    <a href="#" class="logo">
                        <img src="assets/images/logo.png" alt="" width="250">
                    </a>
                </div>
                <div class="header-search col-md-9">
                    <div class="row row-tb-10 ">
                        <div class="col-sm-8">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg search-input" placeholder="Enter Keywork Here ..." required="required">
                                    <div class="input-group-btn">
                                        <div class="input-group">
                                            <select class="form-control input-lg search-select">
                                                <option>Select Your Category</option>
                                                <option>Deals</option>
                                                <option>Coupons</option>
                                                <option>Discounts</option>
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-lg btn-search btn-block">
                                                    <i class="fa fa-search font-16"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 t-xs-center t-md-right">
                            <div class="header-cart">
                                <a href="#">
                                    <span class="icon lnr lnr-cart"></span>
                                    <div><span class="cart-number">0</span>
                                    </div>
                                    <span class="title">Cart</span>
                                </a>
                            </div>
                            <div class="header-wishlist ml-20">
                                <a href="#">
                                    <span class="icon lnr lnr-heart font-30"></span>
                                    <span class="title">Wish List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Header -->

    <!-- Header Menu -->
    <div class="header-menu bg-blue">
        <div class="container">
            <nav class="nav-bar">
                <div class="nav-header">
                    <span class="nav-toggle" data-toggle="#header-navbar">
                        <i></i>
                        <i></i>
                        <i></i>
                    </span>
                </div>
                <div id="header-navbar" class="nav-collapse">
                    <ul class="nav-menu">
                        <li class="active">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('allcoupon') }}">Coupons</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Header Menu -->

</header>

