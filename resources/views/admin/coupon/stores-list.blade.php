@extends('admin.layout.admin-main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Stores List</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Website URL</th>
                            <th>Hidden</th>
                            <th>Store Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->website_url }}</td>
                                <td>{{ $store->is_hidden ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ asset($store->image) }}" target="_blank">
                                        <img src="{{ asset($store->image) }}" alt="Store Image" style="max-width: 50px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <a href="{{ route('admin.edit-stores-list', $store->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <form action="{{ route('admin.delete-store',$store->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this store?')">Delete</button>
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
