@extends('layouts.app')
@section('title', 'Create New Role')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ?? '' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('user-role.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="">User Name *</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select One</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
</div>
@endsection