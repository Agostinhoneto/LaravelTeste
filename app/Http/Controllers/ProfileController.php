<?php

namespace App\Http\Controllers;
use App\Model\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::paginate(10);;
        return view('profiles.index', compact('profiles'));
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        return view('profiles.show', compact('profile'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string',
            'dob'       => 'required',
            'gender'    => 'required',
        ]);

        $profile = new Profile();
            $profile->first_name = $validatedData['first_name'];
            $profile->last_name = $validatedData['last_name'];
            $profile->dob = $validatedData['dob'];
            $profile->gender = $validatedData['gender'];

        $profile->save();

        session()->flash('success', 'Profile successfully saved!');

        return redirect()->route('profiles.index');
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string',
            'dob'       => 'required',
            'gender'    => 'required',
        ]);
        
        $profile = Profile::find($id);
        $profile->first_name = $validatedData['first_name'];
        $profile->last_name = $validatedData['last_name'];
        $profile->dob = $validatedData['dob'];
        $profile->gender = $validatedData['gender'];
        $profile->save();

        session()->flash('success', 'Profile Edit successfully !');

        return redirect()->route('profiles.index');
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->delete();
        session()->flash('success', 'Delete successfully !');

        return redirect()->route('profiles.index');
    }
}
