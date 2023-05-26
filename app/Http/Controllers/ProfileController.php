<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::paginate(10);;
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string',
            'dob'       => 'required',
            'gender'    => 'required',
        ]);

        $profile = new Profile([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
        ]);

        $profile->save();

        session()->flash('success', 'Perfil armazenado com sucesso');

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
