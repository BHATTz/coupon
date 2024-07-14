@extends('admin/layout.admin-main')

@section('content')
    <form id="winnerForm" action="{{ route('admin.coupon.dailyWinnerStore') }}" method="post" enctype="multipart/form-data">
        @csrf

        <section class="content">
            <div class="container-fluid">
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Select</strong>&nbsp;Daily Winner</h2>
                            </div>
                            <div class="body">
                                @if($winnerData != "")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5><strong><span class="text-danger">Number Game Winner For</span> {{date('l d-M-Y', strtotime( today() ))}}</strong></h5>
                                                <span class="btn btn-success">{{$winnerData->number_winner}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5><strong><span class="text-danger">Alphabet Game Winner For</span> {{date('l d-M-Y', strtotime( today() ))}}</strong></h5>
                                                <span class="btn btn-success">{{$winnerData->alphabet_winner}}</span>
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
                                                    <div class="col-md-12">
                                                        <select name="numberWinner" class="form-control">
                                                            <option value="0">--Select Winner For Number Game--</option>
                                                            @for ($i=1;$i<=10;$i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                        @error('numberWinner')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
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
                                                    <div class="col-md-12">
                                                        <select name="AlphabetWinner" class="form-control">
                                                            <option value="0">--Select Winner for Alphabet Game</option>
                                                            @foreach(range('A','Z') as $letter)
                                                                <option value="{{$letter}}">{{$letter}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('AlphabetWinner')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
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
        
        $(document).ready(function(){
            $('#winnerForm').submit(function (event) {
                event.preventDefault();
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to update this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            url: $("#winnerForm").attr('action'),
                            method: "POST",
                            dataType: "json",
                            data: $("#winnerForm").serialize(),
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

                    }
                });

            });
        });
    </script>
@endsection
