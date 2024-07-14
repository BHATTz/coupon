@extends('mainwebsite.layout.main')

@section('allcontent')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Heading and Subheading -->
            <h1 class="display-4">Alphabet Game</h1>
            <p class="lead">Please select an option and confirm it, to save your game. 😊</p>
        </div>
    </div>

    <!-- Game form to choose a alphabet a to z -->
    <div class="row">
        <div class="col-md-12 my-4">
            <form action="{{route('alphabetGame')}}" method="POST" id="alphabetGame" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <input type="hidden" name="coupon" value="{{ $id }}">
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label>Choose a Radio Option:</label><br>
                        @foreach(range('A','Z') as $letter)
                            <div class="col-md-3 text-center p-2">
                                <input type="radio" id="radio{{$letter}}" name="alphabetGameOption" value="{{$letter}}">
                                <label for="radio{{$letter}}"><h4>{{$letter}}</h4></label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" id="saveButton">Save Alphabet</button>
            </form>
            
            
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
    <script>
        $(document).ready(function(){
            $('#alphabetGame').submit(function (event) {
                event.preventDefault();
                $("#saveButton").attr('disabled','true');
                
                $.ajax({
                    url: $("#alphabetGame").attr('action'),
                    method: "POST",
                    dataType: "json",
                    data: $("#alphabetGame").serialize(),
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
                            $("#saveButton").removeAttr('disabled');
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
                        }else{
                            toastr.success('success',data.msg);
                            setTimeout(function() {
                                // location.reload();
                                location.replace("{{route('profiles')}}");
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

@endpush