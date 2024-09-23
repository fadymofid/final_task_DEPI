<?php
namespace App\Services;

use App\Models\Ticket;
use App\Models\Comment;

class TicketService
{
    // Create a new ticket
    public function createTicket($userId, $title, $type, $info)
    {
        return Ticket::create([
            'user_id' => $userId,
            'title' => $title,
            'type' => $type,
            'info' => $info,
        ]);
    }

    // Add a comment to a ticket
    public function addComment($ticketId, $userId, $contents)
    {
        return Comment::create([
            'ticket_id' => $ticketId,
            'user_id' => $userId,
            'contents' => $contents,  // Ensure this is just the user's comment
        ]);
    }
    public function getUserTickets($userId)
    {
        return Ticket::where('user_id', $userId)->get();
    }
    public function getAll(){
        return Ticket::all();

    }

}
