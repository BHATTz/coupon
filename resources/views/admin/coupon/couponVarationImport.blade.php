@extends('admin/layout.admin-main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('admin.import', $couponId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
            <button class="btn btn-primary" type="submit">Import CSV</button>
        </form>
        <a class="btn btn-success" href="{{ route('admin.export', $couponId) }}">Export CSV</a>
    </div>
@endsection
