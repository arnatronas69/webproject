@extends('layouts.admin')

@section('content')
    <h1>{{ $manufacturer->name }}</h1>

    <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="btn btn-primary">Edit</a>
@endsection
