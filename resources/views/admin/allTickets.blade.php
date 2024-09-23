@extends('layouts.app')
@include('admin.adminNav')
@section('content')

    <div class="container">
        <h1>Tickets Management</h1>

        @if($tickets->isEmpty())
            <div class="alert alert-info">No tickets available.</div>
        @else
            <ul class="list-group mt-3">
                @foreach($tickets as $ticket)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $ticket->title }}</strong> <!-- Display ticket title -->
                            <br>
                            <small class="text-muted">Created: {{ $ticket->created_at->diffForHumans() }}</small>
                            <br>
                            <small class="text-muted">Created by: <strong>{{ $ticket->user->name }}</strong></small>
                            <br>
                            <small class="text-muted">Type: <strong>{{ $ticket->type }}</strong></small>
                        </div>

                        <!-- View ticket button -->
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-primary">View</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
