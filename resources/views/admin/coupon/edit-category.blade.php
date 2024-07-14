@extends('admin/layout.admin-main')

@section('content')
    <form id="couponForm" action="{{ route('admin.update-category', $category->id) }}" method="post">
        @csrf

        <section class="content">
            <div class="container-fluid">
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">`
                                <h2><strong>Add</strong> Categories</h2>
                            </div>
                            <div class="body">
                                <!-- Coupon Details -->
                                <h2 class="card-inside-title">Categories Details</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Categories Name" value="{{ $category->name }}">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Coupon Details -->

                <!-- Radio Buttons -->
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="card-inside-title">Visibility</h2>
                            </div>
                            <div class="body">
                                <!-- Coupon Details -->
                                <h2 class="card-inside-title">Categories Visible</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-8">
                                        <div class="radio" style="display: inline-block; margin-right: 20px;">
                                            <input type="radio" name="is_hidden" id="hide-radio" value="1"
                                                {{ $category->is_hidden == '1' ? 'checked' : '' }}>
                                            <label for="hide-radio">Hide</label>
                                        </div>
                                        <div class="radio" style="display: inline-block;">
                                            <input type="radio" name="is_hidden" id="show-radio" value="0"
                                                {{ $category->is_hidden == '0' ? 'checked' : '' }}>
                                            <label for="show-radio">Show</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <button id="submitBtn" type="submit"
                                            class="btn btn-primary btn-round">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Radio Buttons -->
        </section>
    </form>
@endsection
