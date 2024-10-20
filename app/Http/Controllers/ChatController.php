<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Show the chat view and load messages if a user is selected
   public function showChat(Request $request)
{
    // Fetch users with roles 'administrator' or 'faculty' except the currently logged-in user
    $users = User::whereIn('userType', ['administrator', 'faculty'])
                  ->where('id', '!=', Auth::id())
                  ->get();
    
    $selectedUserId = $request->input('user');
    $messages = [];

    if ($selectedUserId) {
        // Fetch chat messages between authenticated user and selected user
        $currentUser = Auth::id();
        $messages = Chat::where(function ($query) use ($currentUser, $selectedUserId) {
            $query->where('sender_id', $currentUser)
                  ->where('receiver_id', $selectedUserId);
        })->orWhere(function ($query) use ($currentUser, $selectedUserId) {
            $query->where('sender_id', $selectedUserId)
                  ->where('receiver_id', $currentUser);
        })->orderBy('created_at', 'asc')->get();
    }

    return view('chat.index', compact('users', 'messages', 'selectedUserId'));
}


    // Send a chat message
    public function sendMessage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        // Create a new chat message
        Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->user_id,
            'message' => $request->message,
        ]);

        // Redirect back to the chat page with the selected user
        return redirect()->route('chat.show', ['user' => $request->user_id]);
    }

    // Add this method to your ChatController
    public function fetchMessages(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $currentUser = Auth::id();
        $selectedUserId = $request->user_id;

        // Fetch the latest chat messages
        $messages = Chat::where(function ($query) use ($currentUser, $selectedUserId) {
            $query->where('sender_id', $currentUser)
                ->where('receiver_id', $selectedUserId);
        })->orWhere(function ($query) use ($currentUser, $selectedUserId) {
            $query->where('sender_id', $selectedUserId)
                ->where('receiver_id', $currentUser);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

}

