@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('key.update', $edit->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" placeholder="Enter major name" name="name" required value="{{ $edit->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <input type="radio" name="is_active" id="" value="1" {{ $edit->is_active == 1 ? 'checked' : '' }}> Active
                    <input type="radio" name="is_active" id="" value="0" {{ $edit->is_active == 0 ? 'checked' : '' }}> Inactive
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection