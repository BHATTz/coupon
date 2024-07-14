@extends('admin.layout.admin-main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Category List</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Hidden</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->is_hidden ? 'Yes' : 'No' }}</td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <a href="{{ route('admin.edit-category', $category->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-2 text-center">
                                        <form action="{{ route('admin.delete-category', $category->id) }}" method="POST">
                                            @csrf
                                             @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
