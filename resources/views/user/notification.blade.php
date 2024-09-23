@extends('layouts.app')
@if(auth()->user() && auth()->user()->type == 'client')
    @include('user.nav')
@endif

@if(auth()->user() && auth()->user()->type == 'admin')
    @include('admin.adminNav')
@endif
@section('content')

    <div class="container">
        <h1>Your Notifications</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($notifications->isEmpty())
            <div class="alert alert-info">You have no notifications.</div>
        @else
            <ul class="list-group mt-3">
                @foreach($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $notification->message }} <!-- Notification message -->
                            <br>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            <br>
                            <!-- Display the sender's name -->
                            <strong>Sent by: {{ $notification->sender->name }}</strong> <!-- Adjust this according to your relationship -->
                        </div>

                        <!-- Mark as read button (optional) -->
                        @if(!$notification->status)
                            <form method="POST" action="{{ route('notifications.read', $notification) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">Mark as Read</button>
                            </form>
                        @endif

                        <!-- Delete notification button (optional) -->

                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
