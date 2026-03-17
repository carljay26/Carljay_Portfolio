<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $admin   = Auth::guard('admin')->user();
        $profile = Profile::first();
        return view('admin.settings', compact('admin', 'profile'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:admins,email,' . $admin->id,
            'current_password'      => 'nullable|string',
            'new_password'          => 'nullable|string|min:8|confirmed',
            'avatar'                => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:2048',
        ], [
            'avatar.image' => 'The profile photo must be an image (JPG, PNG, WebP or GIF).',
            'avatar.max'   => 'The profile photo may not be larger than 2 MB.',
        ]);

        $admin->name  = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('avatar')) {
            $dir = public_path('images/admins');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('avatar');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
            if (!in_array($ext, ['jpeg', 'jpg', 'png', 'webp', 'gif'], true)) {
                $ext = 'png';
            }
            $filename = 'admin_avatar_' . $admin->id . '.' . $ext;
            $file->move($dir, $filename);
            $admin->avatar_path = 'images/admins/' . $filename;
        }

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->save();

        return back()->with('success', 'Settings updated!');
    }
}
