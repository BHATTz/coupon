@extends('admin/layout.admin-main')

@section('content')
    <form id="couponForm" action="{{ route('admin.coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <section class="content">
            <div class="container-fluid">
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Create</strong> Coupon</h2>
                            </div>
                            <div class="body">
                                <!-- Coupon Details -->
                                <h2 class="card-inside-title">Coupon Details</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Coupon Name" value="{{ $coupon->name }}">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="percentage" type="number" class="form-control" placeholder="% Off"
                                                value="{{ $coupon->percentage }}">
                                            @error('percentage')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="price" type="number" class="form-control" placeholder="Price"
                                                value="{{ $coupon->price }}">
                                            @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="website_url" type="text" class="form-control"
                                                placeholder="Website URL" value="{{ $coupon->website_url }}">
                                            @error('website_url')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="sku" type="text" class="form-control" placeholder="sku"
                                                value="{{ $coupon->sku }}">
                                            @error('sku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <select name="category_id" class="form-control show-tick">
                                            <option value="">-- Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $coupon->category_id === $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6">
                                        <select name="brand_id" class="form-control show-tick">
                                            <option value="">-- Brands --</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $coupon->brand_id === $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-sm-6">
                                        <select name="store_id" class="form-control show-tick">
                                            <option value="">-- Stores --</option>
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}"
                                                    {{ $coupon->store_id === $store->id ? 'selected' : '' }}>
                                                    {{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('store')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End Coupon Details -->

                            <!-- Description -->
                            <div class="card">
                                <h2 class="card-inside-title">Description</h2>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="description" rows="4" class="form-control no-resize"
                                                    placeholder="Please type what you want in Description...">{{ $coupon->description }}</textarea>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Description -->

                            <!-- Details -->
                            <div class="card">
                                <h2 class="card-inside-title">Details</h2>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="details" rows="4" class="form-control no-resize"
                                                    placeholder="Please type what you want in Details...">{{ $coupon->details }}</textarea>
                                                @error('details')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Details -->

                            <!-- File Upload | Drag & Drop OR With Click & Choose -->
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2 class="card-inside-title">Logo Picker</h2>

                                        </div>
                                        <div class="body">
                                            <div class="form-group">
                                                <input type="file" name="image" class="form-control-file"
                                                    id="exampleInputFile" aria-describedby="fileHelp">
                                                <small id="fileHelp" class="form-text text-muted">This is some
                                                    placeholder block-level
                                                    help text for the above input. It's a bit lighter and easily wraps
                                                    to a new
                                                    line.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->

                            <!-- Date Time Picker -->
                            <div class="card">
                                <h2 class="card-inside-title">DateTime Picker</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                            <input name="start_date" type="date" class="form-control datetimepicker"
                                                placeholder="Please choose Start date & time..."
                                                value="{{ $coupon->start_date }}">

                                        </div>
                                        @error('start_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                            <input name="expiration_date" type="date"
                                                class="form-control datetimepicker"
                                                placeholder="Please choose End date & time..."
                                                value="{{ $coupon->expiration_date }}">

                                        </div>
                                        @error('expiration_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End Date Time Picker -->
                            {{-- usage limit --}}
                            <h2 class="card-inside-title">Usage Limit</h2>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="usage_limit" type="number" class="form-control"
                                        placeholder="Usage Limit" value="{{ $coupon->usage_limit }}">
                                    @error('usage_limit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- usage limit --}}
                            <!-- Radio Buttons -->
                            <h2 class="card-inside-title">Visibility</h2>
                            <div class="row clearfix">
                                <div class="col-sm-8">
                                    <div class="radio" style="display: inline-block; margin-right: 20px;">
                                        <input type="radio" name="is_hidden" id="hide-radio" value="hide"
                                            {{ $coupon->is_hidden === 0 ? 'checked' : '' }}>
                                        <label for="hide-radio">Hide</label>
                                    </div>
                                    <div class="radio" style="display: inline-block;">
                                        <input type="radio" name="is_hidden" id="show-radio" value="show"
                                            {{ $coupon->is_hidden === 1 ? 'checked' : '' }}>
                                        <label for="show-radio">Show</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <button id="submitBtn" type="submit"
                                        class="btn btn-primary btn-round">Submit</button>
                                </div>
                            </div>
                            <!-- End Radio Buttons -->

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>
@endsection
