@extends('layouts.app')
@if(auth()->user() && auth()->user()->type == 'client')
    @include('user.nav')
@endif

@if(auth()->user() && auth()->user()->type == 'admin')
    @include('admin.adminNav')
@endif
@section('content')
    <div class="container">
        <h1 class="my-4">{{ $ticket->title }}</h1>
        <p><strong>Type:</strong> {{ $ticket->type }}</p>
        <p><strong>Info:</strong> {{ $ticket->info }}</p>
        <p><strong>Created At:</strong> {{ $ticket->created_at->diffForHumans() }}</p>
        <h2>Comments</h2>
        <ul class="list-group">
            @foreach($ticket->comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->contents }}
                    <br>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Add a Comment</h3>
        <form method="POST" action="{{ route('tickets.comments', $ticket) }}">
            @csrf
            <div class="form-group">
                <label for="contents">Add a Comment</label>
                <textarea id="contents" name="contents" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>

    </div>
@endsection
