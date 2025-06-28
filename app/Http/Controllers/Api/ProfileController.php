<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    // ✅ جلب بيانات المستخدم الحالي
    public function show(Request $request)
    {
        $user = $request->user();
        $user->avatar_url = $user->avatar ? url('storage/' . $user->avatar) : null;

        return response()->json($user);
    }

    // ✅ تحديث البيانات الشخصية
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'location'   => 'nullable|string|max:255',
            'bio'        => 'nullable|string|max:1000',
        ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'phone',
            'location',
            'bio'
        ]));

        $user->avatar_url = $user->avatar ? url('storage/' . $user->avatar) : null;

        return response()->json($user);
    }

    // ✅ تحديث صورة البروفايل
    public function updateAvatar(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // حذف الصورة القديمة إذا كانت موجودة
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // رفع الصورة الجديدة
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return response()->json([
            'message' => 'Avatar updated successfully',
            'avatar_url' => url('storage/' . $path),
        ]);
    }
}
