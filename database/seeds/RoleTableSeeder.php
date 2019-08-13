<?php

use Illuminate\Database\Seeder;
use Alley\Modules\Admin\Models\Role;
use Illuminate\Support\Carbon;
use Alley\Modules\BaseRepository;

class RoleTableSeeder extends Seeder
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
        $date = Carbon::now();

        Role::insert([
            ['id'=> $this->baseRepository->generateUuid(), 'name'=> 'admin', 'display_name'=> 'admin', 'created_at'=>$date, 'updated_at'=>$date],

            ['id'=> $this->baseRepository->generateUuid(), 'name'=> 'vendor', 'display_name'=> 'vendor', 'created_at'=>$date, 'updated_at'=>$date],

            ['id'=> $this->baseRepository->generateUuid(), 'name'=> 'user', 'display_name'=> 'user', 'created_at'=>$date, 'updated_at'=>$date],
        ]);
    }
}
