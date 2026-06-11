@extends('layouts.app')
@section('title', 'Edit Menu')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ?? '' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('menu.update', $menu->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name"
                        value="{{ $menu->name }}" required
                        placeholder="Enter your Name">
                </div>
                <div class="col-6 mb-3">
                    <label for="" class="form-label">Parent ID</label>
                    <select name="parent_id" id="" class="form-control">
                        <option value="">Select One</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" {{ $parent->id == $menu->parent_id ? 'selected' : '' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" placeholder="Enter Icon" value="{{ $menu->icon }}">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Sort Order</label>
                    <input type="text" class="form-control" name="sort_order" placeholder="Enter Sort Order" value="{{ $menu->sort_order }}">
                </div>
                <div class="col-6 mt-2">
                    <label for="" class="form-label">URL</label>
                    <input type="text" class="form-control" name="url" placeholder="Enter URL" value="{{ $menu->url }}">
                </div>
                <div class="col-6 mt-3">
                    <label for="" class="form-label d-block">Status</label>
                    <input type="radio" name="is_active" value="1" {{ $menu->is_active == 1 ? 'checked' : '' }}> Active
                    <input type="radio" name="is_active" value="0" {{ $menu->is_active == 0 ? 'checked' : '' }}> Inactive
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label d-block">Assign to Roles</label>
                    @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}" {{ in_array($role->id, $menuRoles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
</div>
@endsection