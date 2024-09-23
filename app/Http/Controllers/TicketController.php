<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    // Get user tickets or all tickets based on user type
    public function myTickets()
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id; // Access the ID directly

        if ($user->type == 'client') {
            $tickets = $this->ticketService->getUserTickets($userId);

            return request()->expectsJson()
                ? response()->json($tickets, Response::HTTP_OK)
                : view('user.allTickets', compact('tickets'));
        }

        if ($user->type == 'admin') {
            $tickets = $this->ticketService->getAll();

            return request()->expectsJson()
                ? response()->json($tickets, Response::HTTP_OK)
                : view('admin.allTickets', compact('tickets'));
        }

        // Handle unauthorized access
        return response()->json(['message' => 'Unauthorized access.'], Response::HTTP_FORBIDDEN);
    }

    // Store a new ticket (Web and API)
    public function store(TicketRequest $request)
    {
        $ticket = $this->ticketService->createTicket(auth()->id(), $request->title, $request->type, $request->info);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully',
                'ticket' => $ticket,
            ], Response::HTTP_CREATED);
        }

        return redirect()->route('tickets.show', $ticket->id);
    }

    // Add a comment to a ticket (Web and API)
    public function addComment(CommentRequest $request, Ticket $ticket)
    {
        $comment = $this->ticketService->addComment($ticket->id, auth()->id(), $request->contents);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => $comment,
            ], Response::HTTP_OK);
        }

        return redirect()->route('tickets.show', $ticket->id);
    }

    public function create()
    {
        return view('user.tickets'); // Adjust the view name if necessary
    }

    public function show(Ticket $ticket)
    {
        return view('user.ticket', compact('ticket')); // Adjust the view name as necessary
    }
}
