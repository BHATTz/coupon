@extends('mainwebsite.layout.main')
@section('allcontent')
<div class="page-container store-page ptb-60">
<div class="container">
    <section class="store-header-area panel t-xs-center t-sm-left">
        <div class="row row-rl-10">
            <div class="col-sm-3 col-md-2 t-center">
                <figure class="pt-20 pl-10">
                    <img src="{{asset($allcoupons->image)}}" alt="">
                </figure>
            </div>
            <div class="col-sm-5 col-md-6">
                <div class="store-about ptb-30">
                    <h3 class="mb-10">{{ $allcoupons->name}}</h3>
                    <div class="rating mb-10">
                        <span class="rating-stars rate-allow" data-rating="3">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o star-active"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                        <span class="rating-reviews">
                        ( <span class="rating-count">205</span> rates )
                        </span>
                    </div>
                    <p class="mb-15">{{ $allcoupons->description }}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">PLAY GAME</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="store-splitter-left">
                    <div class="left-splitter-header prl-10 ptb-20 bg-lighter">
                        <div class="row">
                            <div class="col-12 t-center">
                                <h2 class="text-center w-100" id="myText">{{$singleVariationDetail->coupon_code}}</h2>
                                <button class="btn" onclick="copyContent()"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;Copy</button>
                            </div>
                        </div>
                    </div>
                    <div class="left-splitter-body prl-20 ptb-20">
                        <div class="row row-rl-10 row-tb-10">
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <img src="assets/images/products/thumb_01.jpg" alt="">
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <img src="assets/images/products/thumb_02.jpg" alt="">
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <img src="assets/images/products/thumb_03.jpg" alt="">
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <img src="assets/images/products/thumb_04.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

{{-- modal code --}}


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
                    <a href="{{ route('numbersCouponCode',$allcoupons->id) }}" style="color:white;">Open modal for Game 1-10</a>
                </button>
            </div>
            <div class="col-md-6 button-wrapper d-flex flex-column align-items-center">
                <img src="{{ asset('mainwebsite-assets/images/games/game atoz.jpg') }}" alt="Image for Game a-z" class="img-fluid mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">
                    <a href="{{ route('alphabetCouponCode',$allcoupons->id) }}" style="color:white;">Open modal for Game a-z</a>
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

@endpush

@endsection
