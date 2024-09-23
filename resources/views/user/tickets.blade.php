@extends('layouts.app')
@if(auth()->user() && auth()->user()->type == 'client')
    @include('user.nav')
@endif

@if(auth()->user() && auth()->user()->type == 'admin')
    @include('admin.adminNav')
@endif
@section('content')
    <div class="container">
        <h1>Create a Ticket</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="request">Request</option>
                    <option value="problem">Problem</option>
                </select>
                @error('type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="info">Info</label>
                <textarea id="info" name="info" class="form-control" rows="4" required></textarea>
                @error('info')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit Ticket</button>
        </form>
    </div>
@endsection
