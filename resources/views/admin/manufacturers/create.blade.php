@extends('layouts.admin')

@section('content')
    <h1>Create Manufacturer</h1>

    <form action="{{ route('admin.manufacturers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
