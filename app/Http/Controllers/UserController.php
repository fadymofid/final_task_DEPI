<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Apply filter if search query exists
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "{$search}%")
                ->orWhere('phone_number', 'LIKE', "{$search}%");
        }

        $users = $query->get(); // Adjust the pagination as needed

        // Return a view for web requests, JSON for API requests
        if ($request->expectsJson()) {
            return response()->json($users);
        }

        return view('admin.users', compact('users'));
    }

    public function destroy($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {
            return $request->expectsJson()
                ? response()->json(['message' => 'User not found.'], 404)
                : redirect()->route('users.index')->withErrors(['message' => 'User not found.']);
        }

        $user->delete();

        return $request->expectsJson()
            ? response()->json(['message' => 'User deleted successfully.'])
            : redirect()->route('users.index')->with('status', 'User deleted successfully.');
    }

    public function exportPdf(Request $request)
    {
        // Retrieve users data to be included in the PDF
        $users = User::all();

        // Load the view 'admin.users_pdf' and pass the users data to it
        $pdf = PDF::loadView('admin.users_pdf', compact('users'));

        // For web request, return a PDF download
        if (!$request->expectsJson()) {
            return $pdf->download('users.pdf');
        }

        // For API request, return a JSON response (or handle differently if needed)
        return response()->json(['message' => 'PDF generated.']);
    }
}
