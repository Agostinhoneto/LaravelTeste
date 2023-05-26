<?php
use Illuminate\Database\Seeder;
use App\Profile;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        Profile::create([
            'first_name' => 'Administrador',
            'last_name' => 'Perfil de administrador',
            'dob' => date('Y-m-d'), 
            'gender' => 'male',
        ]);
    }
}
