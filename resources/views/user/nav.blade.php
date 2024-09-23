<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Your App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets.create') }}">Create Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all_tickets') }}">Tickets</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="text-decoration: none;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
