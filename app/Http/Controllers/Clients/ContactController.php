<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class ContactController extends Controller
{
    public function index()
    {
        return view('clients.pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
        ], [
            'name.required' => 'Họ và tên là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'phone.required' => 'Số điện thoại là bắt buộc'
        ]);
        Contact::create([
            'full_name' => $request->name,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'is_replied' => 0
        ]);
        
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'contact',
            'message' => 'Bạn có liên hệ mới từ' .  $request->email,
            'link' => '/contacts',
            'is_read' => 0
        ]);
        
        toastr()->success('Gửi thành công! Quản trị viên sẽ sớm liện hệ với bạn.');
        return redirect()->back();
    }
}
