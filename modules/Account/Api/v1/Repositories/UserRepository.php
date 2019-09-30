<?php
namespace Alley\Modules\Account\Api\v1\Repositories;

use Alley\Events\NewRegisteredVendor;
use Alley\Modules\Account\Models\User;
use Alley\Modules\Account\Models\Role;
use Alley\Modules\Account\Api\v1\Transformers\UserTransformer;
use Alley\Modules\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function registerVendor(array $userData)
    {
        $data = (object)$userData;

        $role = Role::where('role', 'vendor')->first();
        $user = User::create([
            'id'                => $this->generateUuid(),
            'agency_name'       => $data->agency_name,
            'agency_address'    => $data->agency_address,
            'first_name'        => $data->first_name,
            'last_name'         => $data->last_name,
            'email'             => $data->email,
            'phone'             => $data->phone,
            'role'              => $role->role,
            'role_id'           => $role->id,
            'password'          => Hash::make($data->password)
        ]);
        if ($user) {
            event(new NewRegisteredVendor($user));
            return $this->vendorLogin($userData);//($userData, $role);
        }
        return false;
    }


    public function vendorLogin(array $data)
    {
        $credentials = collect($data)->only(['email', 'password']);
        if ($token = auth()->attempt($credentials->toArray())) {
            $user = auth()->user();
            $user = fractal($user, new UserTransformer())->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
            return response()->json(["status" => "success", "token" => $token, "user" => $user]);
        }
        return response()->json(["status" => "error", "message" => "Invalid email or password"]);
    }

    public function adminLogin(array $data)
    {
        $credentials = collect($data)->only(['email', 'password']);
        if ($token = auth()->attempt($credentials->toArray())) {
            $admin = auth()->user();
            $admin = fractal($admin, new UserTransformer())->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
            return response()->json(["status" => "success", "token" => $token, "user" => $admin]);
        }
        return response()->json(["status" => "error", "message" => "Invalid email or password"]);
    }


    public function getAllVendor()
    {
        $user = User::whereRole('vendor')->get();
        return $user;
    }


    public function getVendorById($id)
    {
        $user = $this->user->where('id',$id)->first();
        return $user;
    }


    public function updateVendor(array $request, $id)
    {
        $data = (object)$request;

        $role = Role::where('role', 'vendor')->first();
        $user = User::where('id', $id)->first();
        $user->update([
            'agency_name'    => $data->agency_name,
            'agency_address' => $data->agency_address,
            'first_name'     => $data->first_name,
            'last_name'      => $data->last_name,
            'email'          => $data->email,
            'phone'          => $data->phone,
        ]);

        if ($role && $user)
            return $user;
        return response()->json(['status'=>'success'], ['message' => 'Vendor Data Successfully Updated!!']);

    }

    public function deleteVendor($id)
    {
        $user= $this->user->where('id', $id)->delete();
        if ($user){
            return "Vendor Deleted Successfully!!";
        }
    }

}