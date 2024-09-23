@extends('layouts.app')
@include('admin.adminNav')

@section('content')

    <div class="container">
        <h1>User Management</h1>

        <form action="{{ route('users.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request()->get('search') }}">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </form>

        <a href="{{ route('users.exportPdf') }}" class="btn btn-success mb-3">Export to PDF</a>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->type=='client')
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('notifications.create', ['userId' => $user->id]) }}" class="btn btn-secondary btn-sm">Send Notification</a>                    </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>


    </div>

@endsection
