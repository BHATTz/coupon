@extends('admin/layout.admin-main')

@section('content')
    <form id="couponForm" action="{{ route('admin.coupon.DailyCouponStore') }}" method="post" enctype="multipart/form-data">
        @csrf

        <section class="content">
            <div class="container-fluid">
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Create</strong>&nbsp;Daily GameVariable</h2>
                            </div>
                            <div class="body">
                                @if($gameCodeData != "")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4><strong><span class="text-danger">Number Game For</span> {{date('l d-M-Y', strtotime($gameCodeData->publish_date))}}</strong></h4>
                                                <span class="btn btn-success">{{$gameCodeData->game_code_number}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4><strong><span class="text-danger">Alphabet Game For</span> {{date('l d-M-Y', strtotime($gameCodeData->publish_date))}}</strong></h4>
                                                <span class="btn btn-success">{{$gameCodeData->game_code_alphabet}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endif

                                <!-- Coupon Details -->
                                <div class="row clearfix">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="card">
                                                <h2 class="card-inside-title">Codes For Number Game</h2>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input name="numberGame" type="text" class="form-control" placeholder="Number Game Code" id="randomFieldNumber" autocomplete="off">
                                                        @error('numberGame')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-danger m-0 p-2" onClick="randomStringNumber();">Generate Code</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="card">
                                                <h2 class="card-inside-title">Codes For Alphabet Game</h2>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input name="AlphabetGame" type="text" class="form-control" placeholder="Alphabet Game Code" id="randomFieldAlphabet" autocomplete="off">
                                                        @error('AlphabetGame')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-danger m-0 p-2" onClick="randomStringAlphabet();">Generate Code</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4 text-center">
                                            <button id="submitBtn" type="submit" class="btn btn-primary btn-round">Submit</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- End Coupon Details -->
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>
@endsection

@section('admin-scripts')

    <script>
        function randomStringNumber(){
            var characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
            var lenString = 24;
            var randomstring = '';

            for (var i=0; i<lenString; i++) {
                var rnum = Math.floor(Math.random() * characters.length);
                randomstring += characters.substring(rnum, rnum+1);
            }

            document.getElementById("randomFieldNumber").value = randomstring;
        }

        function randomStringAlphabet() {
            var characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
            var lenString = 24;
            var randomstring = '';

            for (var i=0; i<lenString; i++) {
                var rnum = Math.floor(Math.random() * characters.length);
                randomstring += characters.substring(rnum, rnum+1);
            }

            document.getElementById("randomFieldAlphabet").value = randomstring;
        }

        $(document).ready(function(){
            $('#couponForm').submit(function (event) {
                event.preventDefault();
                
                $.ajax({
                    url: $("#couponForm").attr('action'),
                    method: "POST",
                    dataType: "json",
                    data: $("#couponForm").serialize(),
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
                        }else if(data.status == 2){
                            toastr.error('error',data.msg);
                            setTimeout(function() {
                                location.replace("{{route('login')}}");
                            },1000);
                        }else{
                            toastr.success('success',data.msg);
                            setTimeout(function() {
                                location.reload();
                                // location.replace("");
                            }, 1500);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
