<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        $active   = $messages->first();
        return view('admin.messages', compact('messages', 'active'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }
        $messages = ContactMessage::latest()->get();
        return view('admin.messages', ['messages' => $messages, 'active' => $message]);
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate(['reply_text' => 'required|string']);
        $message->update([
            'reply_text' => $request->reply_text,
            'replied_at' => now(),
            'is_read'    => true,
            'read_at'    => $message->read_at ?? now(),
        ]);
        return back()->with('success', 'Reply saved!');
    }

    public function markRead(ContactMessage $message)
    {
        $message->update(['is_read' => true, 'read_at' => now()]);
        return back();
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages')->with('success', 'Message deleted.');
    }
}
