<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                'regex:/^[\w\.-]+@([\w-]+\.)+(vn|com)$/', // Email kết thúc bằng .vn
                'unique:users,email'
            ],
            'subject' => 'nullable|string|max:255', // nếu bạn cần thêm subject
            'content' => 'required|string|min:5',
        ]);
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'content' => $request->content,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã gửi liên hệ!');
    }
}
