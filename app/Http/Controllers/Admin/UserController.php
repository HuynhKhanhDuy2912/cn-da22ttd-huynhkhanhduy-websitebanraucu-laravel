<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::with('role')->paginate(9);
        return view('admin.pages.users', compact('users'));
    }

    public function upgrade(Request $request)
    {
        $userId = $request->user_id;

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy người dùng.']);
        }

        $user->role_id = 2; //Role of Staff
        $user->save();
        return response()->json(['status' => true, 'message' => 'Nâng cấp người dùng thành nhân viên thành công!'], 200);
    }

    public function updateStatus(Request $request)
    {
        $userId = $request->user_id;
        $newStatus = $request->status;

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy người dùng.']);
        }

        $user->status = $newStatus;
        $user->save();
        return response()->json(['status' => true, 'message' => 'Cập nhật trạng thái người dùng thành công!'], 200);
    }
}
