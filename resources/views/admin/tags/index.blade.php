@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tags</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>
                                <a href="{{ route('admin.tags.show', $tag->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $tags->links() }}
        </div>
    </div>
@endsection
