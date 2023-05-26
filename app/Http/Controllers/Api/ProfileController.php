<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    public function store(Request $request)
    {
        $profile = Profile::create($request->all());
        return response()->json($profile, 201);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        dd($profile);
        if (!$profile) {
            return (new ResponseController)->error('Perfil não encontrado', 404);
        }
    
        return (new ResponseController)->success('Perfil encontrado', $profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(null, 204);
    }
}
