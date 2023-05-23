@extends('layouts.admin')

@section('content')
    <h1>{{ $category->name }}</h1>

    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
@endsection
