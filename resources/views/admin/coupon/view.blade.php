@extends('admin/layout.admin-main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Coupon List</h1>
        </div>
    </section>
@endsection
