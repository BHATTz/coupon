@extends('mainwebsite.layout.main')
@push('custom-css')
    <style>
        .my-20{
            margin-bottom:20px !important;
        }
    </style>
@endpush
@section('allcontent')
<div class="card">
    <div class="card-body">
  
        <div class="container my-20">
            <div class="row">
                <div class="col-md-12">
                    <!-- Heading and Subheading -->
                    <h1 class="display-4">Number Game</h1>
                    <p class="lead">Please select an option and confirm it, to save your game. 😊</p>
                </div>
            </div>
            <!-- Game form to choose a number from 1 to 10 -->
            <?php
                // dd($data);
            ?>
            <div class="row">
                <div class="col-md-12 my-4">
                    <form action="{{ route('numbergame') }}" method="POST" id="numberGame" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="hidden" name="pay_order_id" value="{{ $data['order_id'] }}">
                            <input type="hidden" name="coupon" value="{{ $id }}">
                        </div>

                        <div class="form-group">
                            <label>Choose a Radio Option:</label><br>
                            <div class="row">
                                @for($i=1;$i<=10;$i++)
                                    <div class="col-md-3">
                                        <input type="radio" id="radio{{$i}}" name="numberGameOption" value="{{$i}}">
                                        <label for="radio{{$i}}"><h4>{{$i}}</h4></label>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        {{-- <button type="submit" class="btn btn-primary" id="saveButton">Save Number</button> --}}
                        <button type="submit" class="btn btn-primary" id="rzp-button1">Save Number</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('custom-scripts')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $(document).ready(function(){
        $('#numberGame').submit(function (event) {
            event.preventDefault();
            $("#rzp-button1").attr('disabled','true');
            
            $.ajax({
                url: $("#numberGame").attr('action'),
                method: "POST",
                dataType: "json",
                data: $("#numberGame").serialize(),
                success: function (data) {
                    console.log(data);
                    if(data.status == 0){
                        if(data.msg != ""){
                            toastr.warning(data.msg);
                        }else{
                            var validationErrors = [data.errors];
                            $.each(validationErrors, function(key,value) {
                                var input = value;
                                console.log(input);
                                $.each(input, function(k,v) {
                                    console.log(k);
                                    var errorMessage = v.join(', ');
                                    // toastr.error(errorMessage, k);
                                    toastr.error(errorMessage);
                                });
                            });
                        }
                        $("#rzp-button1").removeAttr('disabled');
                    }else if(data.status == 2){
                        toastr.error('error',data.msg);
                        setTimeout(function() {
                            location.replace("{{route('login')}}");
                        },1000);
                    }else if(data.status == 3){
                        toastr.error('error',data.msg);
                        setTimeout(function() {
                            location.replace("{{route('allcoupon')}}");
                        },1000);
                    }else if(data.status == 1) {
                        rzp1.open();
                        toastr.success('success',data.msg);
                        // setTimeout(function() {
                        //     // location.reload();
                        //     location.replace("{{route('profiles')}}");
                        // }, 1500);
                    }else{
                        toastr.warning('warning',data.msg);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });

        });

        var options = {
            "key": "{{$data['key']}}",
            "amount": "{{$data['amount']}}",
            "currency": "{{$data['currency']}}",
            "name": "{{$data['name']}}", 
            "order_id": "{{$data['order_id']}}",
            // "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
            "handler": function (response){
                // console.log(response);
                var url = '{{ route("razorpaySuccess",['','']) }}'+'/'+response.razorpay_payment_id+'/'+response.razorpay_order_id;
                url = url.replace(':payid', response.razorpay_payment_id);
                url = url.replace(':orderid', response.razorpay_order_id);
                window.location.href = url;
            },
            "prefill": { 
                "name": "{{$auth->name}}",
                "email": "{{$auth->email}}",
                "contact": "{{$auth->phone}}"
            },
            "notes": {
                "address": "Razorpay Corporate Office"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
        });

    });

    
    // document.getElementById('rzp-button1').onclick = function(e){
    //     rzp1.open();
    //     e.preventDefault();
    // }
</script>

@endpush

