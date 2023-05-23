@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tag Details</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" value="{{ $tag->name }}" readonly>
            </div>
        </div>
    </div>
@endsection
