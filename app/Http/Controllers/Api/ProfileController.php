<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // جلب بيانات المستخدم الحالي
    public function show(Request $request)
    {
        $user = $request->user();
        $user->avatar_url = $user->avatar ? asset('storage/' . $user->avatar) : null;

        return response()->json($user);
    }

    // تحديث البيانات الشخصية
    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->only([
            'first_name',
            'last_name',
            'phone',
            'location',
            'bio'
        ]);

        $user->update($data);

        return response()->json($user);
    }

    // تحديث صورة البروفايل
    public function updateAvatar(Request $request)
    {
        $user = $request->user();

        if (!$request->hasFile('avatar')) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return response()->json([
            'avatar_url' => asset('storage/avatars/' . $path)
        ]);
    }
}
