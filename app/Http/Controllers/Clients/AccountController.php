<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('clients.pages.account', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ltn__name' => 'required|string|max:255',
            'ltn__phone_number' => 'nullable|string|max:15',
            'ltn__address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        //handle avatar
        if($request->hasFile('avatar'))
        {
            //Delete old photo if exists
            if($user->avatar && Storage::disk('public')->exists($user->avatar)){
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');

            //Create new name with timestamp
            $filename = time() . '_' . uniqid() . '.' .$file->getClientOriginalExtension();

            //Save image to folder
            $avatarPath = $file->storeAs('uploads/users', $filename, 'public');
            $user->avatar = $avatarPath;
        }
        
        $user->name = $request->input('ltn__name');
        $user->phone_number = $request->input('ltn__phone_number');
        $user->address = $request->input('ltn__address');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin thành công.',
            'avatar' => asset('storage/' .$user->avatar)
        ]);
    }
}
