<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $profile = new Profile([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
        ]);

        $profile->save();

        return redirect()->route('profiles.index');
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->dob = $request->input('dob');
        $profile->gender = $request->input('gender');
        $profile->save();

        return redirect()->route('profiles.index');
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->delete();

        return redirect()->route('profiles.index');
    }
}
