<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SocialNetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        return view('admin.social_networks');
    }

    /**
     * @param Request $request
     * @return bool|int|mixed|null
     */
    public function changeShow(Request $request)
    {
        $validated = $request->validate([
            'sn_id' => 'required|numeric'
        ]);
        try {
            $sn = SocialNetwork::withTrashed()->findOrFail($validated['sn_id']);

            if ($sn) {
                if ($sn->show_in_register == 1) {
                    $sn->show_in_register = 0;
                } else $sn->show_in_register = 1;
                return $sn->save();
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return bool|int|mixed|null
     */
    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'sn_id' => 'required|numeric'
        ]);
        try {
            $sn = SocialNetwork::withTrashed()->findOrFail($validated['sn_id']);

            if($sn){
                if($sn->deleted_at != null){
                    return $sn->restore();
                }
                return $sn->delete();
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    public function getSocialNetworks(Request $request)
    {
        if ($request->ajax()) {
            $sn = SocialNetwork::query()->withTrashed()->orderBy('id', 'desc');
            return DataTables::of($sn)->toJson();
        }
        return view('/admin/index');
    }

    public function edit(Request $request){
        $validated = $request->validate([
            'image' => 'nullable|mimes:jpeg,bmp,png,jpg,webp',
            'name' => 'required|min:3|max:255',
            'url' => 'required|min:5|max:255',
            'sn_id' => 'required|numeric'
        ]);

        try{
            $sn = SocialNetwork::withTrashed()->findOrFail($validated['sn_id']);
            $sn->url = $validated['url'];
            $sn->name = $validated['name'];

            if(isset($validated['image'])){
                $imageName = $sn->image;

                $request->file('image')->storeAs(
                    '/public/user_images', $imageName
                );
            }

            $sn->save();
            return ['success'=>true];
        } catch (\Exception $e){
            return ['success'=>false,'message' => '500, Internal server error:'.$e->getMessage()];
        }
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50|unique:social_networks',
            'url' => 'required|min:10|max:255|unique:social_networks',
            'image' => 'required|mimes:jpeg,bmp,png,jpg,webp',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->file('image')->storeAs(
            '/public/user_images', $imageName
        );

        $validated['image'] = $imageName;

        SocialNetwork::create($validated);
        return redirect()->route('social_networks');
    }
}
