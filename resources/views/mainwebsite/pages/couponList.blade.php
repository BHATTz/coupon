@extends("mainwebsite.layout.main")

@push('custom_css')
    <style>
        img.store-logo {
            height: 200px;
            width: 100%;
        }
    </style>
@endpush

@section('allcontent')

<div class="col-lg-12">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">

            <!-- Coupons Area -->
            <div class="section coupons-area coupons-area-grid">

                <!-- Page Control -->
                <header class="page-control panel ptb-15 prl-20 pos-r mb-30">

                    <!-- List Control View -->
                    <ul class="list-control-view list-inline">
                        <li><a href="coupons_list.html"><i class="fa fa-bars"></i></a>
                        </li>
                        <li><a href="coupons_grid.html"><i class="fa fa-th"></i></a>
                        </li>
                    </ul>
                    <!-- End List Control View -->

                    <div class="right-10 pos-tb-center">
                        <select class="form-control input-sm">
                            <option>SORT BY</option>
                            <option>Newest items</option>
                            <option>Best sellers</option>
                            <option>Best rated</option>
                            <option>Price: low to high</option>
                            <option>Price: high to low</option>
                        </select>
                    </div>
                </header>
                <!-- End Page Control -->
                <div class="row row-masnory row-tb-20">
                @foreach ( $allcoupons as $allcoupon )

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="coupon-single panel t-center">
                            <div class="ribbon-wrapper is-hidden-xs-down">
                                <div class="ribbon">Featured</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-center p-20">

                                        <img class="store-logo" src="{{ asset($allcoupon->image) }}" alt="">
                                    </div>
                                    <!-- end media -->
                                </div>
                                <!-- end col -->

                                <div class="col-xs-12">
                                    <div class="panel-body">
                                        <ul class="deal-meta list-inline mb-10">
                                            <li class="color-green"><i class="ico lnr lnr-smile mr-5"></i>Verifed</li>
                                            <li class="color-muted"><i class="ico lnr lnr-users mr-5"></i>125 Used</li>
                                        </ul>
                                        <h4 class="color-green mb-10 t-uppercase">{{$allcoupon->percentage}}% OFF</h4>
                                        <h5 class="deal-title mb-10">
                                            <a href="#">{{$allcoupon->name}}</a>
                                        </h5>
                                        <p class="mb-15 color-muted mb-20 font-12"><i class="lnr lnr-clock mr-10"></i>Expires On {{ $allcoupon->expiration_date }}</p>
                                        <div class="showcode">
                                            {{-- <button class="show-code btn btn-sm btn-block" data-toggle="modal" data-target="#coupon_01">Get Coupon Code</button> --}}
                                            <button class="show-code btn btn-sm btn-block get_coupon" data-toggle="modal" data-toggle="modal" 
                                                <?php 
                                                    $authCheck = Auth::user();
                                                ?>
                                                @if($authCheck)
                                                data-target="#exampleModal" data-cuopon="{{$allcoupon->id  }}">
                                                    <!-- <a href={{ route('allcoupondetail',$allcoupon->id) }} >Get Coupon Code</a></button> -->
                                                    Get Coupon Code
                                                </button>
                                                @else
                                                >
                                                    <a href={{ route('login') }} >Get Coupon Code</a></button>
                                                @endif
                                            <div class="coupon-hide">X455-17GT-OL58</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>

                        <div class="modal fade get-coupon-area" tabindex="-1" role="dialog" id="coupon_01">
                            <div class="modal-dialog">
                                <div class="modal-content panel">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="row row-v-10">
                                            <div class="col-md-10 col-md-offset-1">
                                                <img src="assets/images/brands/store_logo.jpg" alt="">
                                                <h3 class="mb-20">Save 30% off New Domains Names</h3>
                                                <p class="color-mid">Not applicable to ICANN fees, taxes, transfers,or gift cards. Cannot be used in conjunction with any other offer, sale, discount or promotion. After the initial purchase term.</p>
                                            </div>
                                            <div class="col-md-10 col-md-offset-1">
                                                <a href="#" class="btn btn-link">Visit Our Store</a>
                                            </div>
                                            <div class="col-md-10 col-md-offset-1">
                                                <h6 class="color-mid t-uppercase">Click below to get your coupon code</h6>
                                                <a href="#" target="_blank" class="coupon-code">X455-17GT-OL58</a>
                                            </div>
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="like-report mb-10">
                                                    <span>Share this coupon :</span>
                                                    <ul class="list-inline social-icons social-icons--colored mt-10">
                                                        <li class="social-icons__item">
                                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li class="social-icons__item">
                                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li class="social-icons__item">
                                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                                        </li>
                                                        <li class="social-icons__item">
                                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer footer-info t-center ptb-40 prl-30">
                                        <h4 class="mb-15">Subscribe to Mail</h4>
                                        <p class="color-mid mb-20">Get our Daily email newsletter with Special Services, Updates, Offers and more!</p>
                                        <form method="post" action="#">
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-white" placeholder="Your Email Address" required="required">
                                                <span class="input-group-btn">
                                                    <button class="btn" type="submit">Sign Up</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>
                <!-- Page Pagination -->
                <div class="page-pagination text-center mt-30 p-10 panel">
                    <nav>
                        <!-- Page Pagination -->
                        <ul class="page-pagination">
                            <li><a class="page-numbers previous" href="#">Previous</a>
                            </li>
                            <li><a href="#" class="page-numbers">1</a>
                            </li>
                            <li><span class="page-numbers current">2</span>
                            </li>
                            <li><a href="#" class="page-numbers">3</a>
                            </li>
                            <li><a href="#" class="page-numbers">4</a>
                            </li>
                            <li><span class="page-numbers dots">...</span>
                            </li>
                            <li><a href="#" class="page-numbers">20</a>
                            </li>
                            <li><a href="#" class="page-numbers next">Next</a>
                            </li>
                        </ul>
                        <!-- End Page Pagination -->
                    </nav>
                </div>
                <!-- End Page Pagination -->
            </div>
            <!-- End Coupons Area -->

        </div>
    </div>


<!-- popup-modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="popbody modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Two Types of Game</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row button-container">
            <div class="col-md-6 button-wrapper d-flex flex-column align-items-center">
                <img src="{{ asset('mainwebsite-assets/images/games/game 1to10.jpg') }}" alt="Image for Game 1-10" class="img-fluid mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                <a href="" id="number_game">Open modal for Game 1-10</a>
                </button>
            </div>
            <div class="col-md-6 button-wrapper d-flex flex-column align-items-center">
                <img src="{{ asset('mainwebsite-assets/images/games/game atoz.jpg') }}" alt="Image for Game a-z" class="img-fluid mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">
                  <a href="" id="alphabet_game"> Open modal for Game a-z</a>
                </button>
            </div>
        </div>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- popup-modal -->



</main>


@push('custom-scripts')
    <script type="text/javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            modal.find('.modal-title').text('Two Types Of Game')
            modal.find('.modal-body input').val(recipient)
        })
    </script>

    <script>
        let text = document.getElementById('myText').innerHTML;
        const copyContent = async () => {
            try {
                await navigator.clipboard.writeText(text);
                console.log('Content copied to clipboard');
                toastr.success('Success',"Content copied to clipboard");
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>

  <script>
            jQuery(".get_coupon").click(function(){
       let coupon=$(this).data("cuopon");

       // Get the current URL
            var currentUrl = window.location.href;

            // Create a URL object
            var url = new URL(currentUrl);

            // Get the base URL (protocol + hostname + port if present)
            var baseUrl = url.protocol + '//' + url.hostname + (url.port ? ':' + url.port : '');

           
      let number_url=baseUrl+"/numbersGame/"+coupon; 
      let alphabet_url=baseUrl+"/alphabetsGame/"+coupon; 
     jQuery("#number_game").prop("href", number_url);
     jQuery("#alphabet_game").prop("href", alphabet_url);
      
    }) 
    </script>

@endpush





@endsection


