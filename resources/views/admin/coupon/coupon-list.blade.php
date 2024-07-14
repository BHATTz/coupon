@extends('admin.layout.admin-main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Coupon List</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Percentage</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Hidden</th>
                            <th>Sku</th>
                            <th>View Varation</th>
                            <th>Create Varation</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->percentage }}%</td>
                                <td>{{ $coupon->price }}</td>
                                <td>{{ $coupon->category->name }}</td>
                                <td>{{ $coupon->is_hidden ? 'Yes' : 'No' }}</td>
                                <td>{{ $coupon->sku }}</td>

                                <td>

                                    <a href="{{ route('admin.couponvaration', $coupon->id) }}"
                                        class="btn btn-success btn-sm">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.couponvaration', $coupon->id) }}"
                                        class="btn btn-secondary btn-sm">Create</a>
                                </td>

                                <td>
                                    <div class="col-sm-2 text-center">
                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this coupon? All the related vartians deleted?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
