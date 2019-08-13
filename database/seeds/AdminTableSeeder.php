<?php

use Illuminate\Database\Seeder;
use Alley\Modules\Admin\Models\Admin;
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
     */
    public function run()
    {
        Admin::create([
            'id'=> $this->baseRepository->generateUuid(),
            'name'=> 'Alley',
            'phone'=> '07014069946',
            'email'=> 'alley@gmail.com',
            'password'=> Hash::make('password'),

        ]);
    }
}
