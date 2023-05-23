@extends('layouts.admin')

@section('content')
    <h1>Manufacturers</h1>

    <a href="{{ route('admin.manufacturers.create') }}" class="btn btn-primary mb-3">Create Manufacturer</a>

    @if ($manufacturers->isEmpty())
        <p>No manufacturers found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->name }}</td>
                        <td>
                            <a href="{{ route('admin.manufacturers.show', $manufacturer->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this manufacturer?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $manufacturers->links() }}
    @endif
@endsection
