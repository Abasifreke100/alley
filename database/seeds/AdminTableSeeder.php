<?php

use Illuminate\Database\Seeder;
use Alley\Modules\Account\Models\User;
use Alley\Modules\Account\Models\Role;
use Illuminate\Support\Facades\Hash;
use Alley\Modules\BaseRepository;

class AdminTableSeeder extends Seeder
{

    private $baseRepository;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->baseRepository=$baseRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     *
     *
     *

     */
    public function run()
    {
        $role = Role::where('role', 'admin')->first();
        User::create([
            'id'=> $this->baseRepository->generateUuid(),
            'first_name'=> 'Wisdom',
            'last_name'=> 'Ekpot',
            'phone'=> '07014069946',
            'email'=> 'alley@gmail.com',
            'password'=> Hash::make('password'),
            'role_id'=>$role->id,
            'role' =>$role->role,


        ]);
    }
}
