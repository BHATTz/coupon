@extends('admin.layout.admin-main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Brands List</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Website URL</th>
                            <th>Hidden</th>
                            <th>Brand Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand as $brand1)
                            <tr>
                                <td>{{ $brand1->name }}</td>
                                <td>{{ $brand1->website_url }}</td>
                                <td>{{ $brand1->is_hidden ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ asset($brand1->image) }}" target="_blank">
                                        <img src="{{ asset($brand1->image) }}" alt="Store Image" style="max-width: 50px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <a href="{{ route("admin.edit-brands-list",$brand1->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <form action="{{ route('admin.delete-brand',$brand1->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
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
