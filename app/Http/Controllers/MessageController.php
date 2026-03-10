<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Show the contact / send message form.
     */
    public function create(): View
    {
        return view('contact');
    }

    /**
     * Store a new message from the contact form.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Message::create($validated);

        return redirect()->route('contact')->with('success', 'MESSAGE SENT SUCCESSFULLY! ✔');
    }

    /**
     * Display all messages (authenticated users only).
     */
    public function index(): View
    {
        $messages = Message::latest()->paginate(10);

        return view('messages.index', compact('messages'));
    }

    /**
     * Display a single message (authenticated users only).
     */
    public function show(Message $message): View
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('messages.show', compact('message'));
    }

    /**
     * Delete a message (authenticated users only).
     */
    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'MESSAGE DELETED! ✔');
    }
}
