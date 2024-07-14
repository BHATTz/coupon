@extends('mainwebsite.layout.main')
@section('allcontent')
<div class="page-container store-page ptb-60">
    <div class="container">
        <section class="store-header-area panel t-xs-center t-sm-left">
            <div class="row row-rl-10">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

                @if(Session::get('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="store-splitter-left">
                        <div class="left-splitter-header prl-10 ptb-20 bg-lighter">
                            <div class="row">
                                <div class="col-12 t-center">
                                    <h2 class="text-center w-100" id="myText">{{$var_data->coupon_code}}</h2>
                                    <button type="button" class="btn" onclick="copyContent()"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;Copy</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="left-splitter-body prl-20 ptb-20">
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
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@push('custom-scripts')

<script>
    let text = document.getElementById('myText').innerHTML;
    const copyContent = async()=>{
        try {
            await navigator.clipboard.writeText(text);
            console.log('Content copied to clipboard');
            toastr.success('Success',"Content copied to clipboard");
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    };
</script>

@endpush