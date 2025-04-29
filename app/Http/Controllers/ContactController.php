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
            'subject' => 'required|string|max:255', // nếu bạn cần thêm subject
            'content' => 'required|string|min:5',
        ], [
            
            'subject.required' => 'Vui lòng nhập tiêu đề.',
            'subject.max' => 'Tiêu đề không được vượt quá 225 ký tự.',
        
            'content.required' => 'Vui lòng nhập nội dung.',
            'content.min' => 'Nội dung phải có ít nhất 5 ký tự.',
        ]);
        Contact::create([
            'content' => $request->content,
            'user_id' => Auth::check() ? Auth::id() : null,
            'subject' => $request->subject,
        ]);

        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã gửi liên hệ!');
    }
}
