@extends('layouts.app')
@if(auth()->user() && auth()->user()->type == 'client')
    @include('user.nav')
@endif

@if(auth()->user() && auth()->user()->type == 'admin')
    @include('admin.adminNav')
@endif
@section('content')

    <div class="container">
        <h1>Your Tickets</h1>

        @if($tickets->isEmpty())
            <div class="alert alert-info">You have no tickets.</div>
        @else
            <ul class="list-group mt-3">
                @foreach($tickets as $ticket)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $ticket->title }}</strong> <!-- Display ticket title -->
                            <br>
                            <small class="text-muted">Type: <strong>{{ $ticket->type }}</strong></small>
                            <br>
                            <small class="text-muted">Created at: {{ $ticket->created_at->diffForHumans() }}</small>
                        </div>

                        <!-- View ticket button -->
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-primary">View</a>


                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
