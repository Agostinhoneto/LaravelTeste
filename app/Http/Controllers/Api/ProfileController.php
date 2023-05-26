<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Model\Profile;

use Illuminate\Http\Request;

class ProfileController extends ResponseController
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return (new ResponseController)->error('Perfil não encontrado', 404);
        }
    
        return (new ResponseController)->success('Perfil encontrado', $profile);
    }

    public function store(Request $request)
    {
        $profile = Profile::create($request->all());
        return response()->json($profile, 201);
    }

    public function update(Request $request, $id)
    {
    
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil não encontrado'], 404);
        }

        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil não encontrado'], 404);
        }

        $profile->delete();
        return response()->json(['message' => 'Perfil excluído com sucesso']);
    }
}
