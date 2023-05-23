@extends('layouts.admin')

@section('content')
    <h1>Edit Manufacturer</h1>

    <form action="{{ route('admin.manufacturers.update', $manufacturer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $manufacturer->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
