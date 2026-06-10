@extends('layouts.app')
@section('title', 'Edit Instructor')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ?? '' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('instructor.update', $edit->id) }}" method="post">
            @csrf
            @method('PUT')
           <div class="mb-3">
                <label for="">Major *</label>
                <select name="major_id" id="" class="form-control">
                    <option value="">Select One</option>
                    @foreach($majors as $major)
                       <option {{ $major->id == $edit->major_id ? 'selected' : '' }} value="{{ $major->id }}">{{ $major->name }}</option> 
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Name *</label>
                <input name="name" type="text" class="form-control" placeholder="Enter your name" required value="{{ $edit->name }}">
            </div>
            <div class="mb-3">
                <label for="">Phone *</label>
                <input name="phone" type="number" class="form-control" placeholder="Enter your phone number" value="{{ $edit->phone }}">
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
</div>
@endsection