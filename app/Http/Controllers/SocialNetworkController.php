<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    public function index()
    {
        return view('admin.social_networks', ['social_networks' => SocialNetwork::all()]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50|unique:social_networks',
            'url' => 'required|min:10|max:255|unique:social_networks',
            'image' => 'required|mimes:jpeg,bmp,png,jpg,webp',
        ]);

        $imageName = $path = $request->file('image')->store('public');
        $validated['image'] = $imageName;

        SocialNetwork::create($validated);
        return redirect()->route('social_networks');
    }
}
