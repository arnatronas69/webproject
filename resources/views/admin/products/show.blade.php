@extends('layouts.admin')

@section('content')
    <h1>Product Details</h1>

    <h3>Name: {{ $product->name }}</h3>
    <p>Price: {{ $product->price }}</p>

    <!-- Display other product details -->

    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>
@endsection
