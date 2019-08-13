<?php
namespace Alley\Modules\Account\Api\v1\Repositories;

use Illuminate\Support\Facades\Hash;
use Alley\Modules\Account\Api\v1\Transformers\UserTransformer;
use Alley\Modules\Account\Models\User;
use Alley\Modules\BaseRepository;

class UserRepository extends BaseRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user=$user;

    }

    public function index()
    {
        return User::all();
    }

    public function getById($id)
    {
        $user = $this->user->findOrFail($id);
        return $user;
    }

    public function register(array $userData)
    {
        $data = (object)$userData;

        $user = User::create([
            "id"                => $this->generateUuid(),
            "first_name"        => $data->first_name,
            "last_name"         => $data->last_name,
            "email"             => $data->email,
            "phone"             => $data->phone,
            "gender"            => $data->gender,
            "location"           => $data->location,
        ]);

        if ($user) {
                return $this->login($userData);
            }
            return false;

    }

    public function login(array $data){
        $credentials = collect($data)->only(['email','password']);
        if($token = auth()->attempt($credentials->toArray())){
            $user = auth()->user();
            $user = fractal($user, new UserTransformer())->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
            return response()->json(["status"=>"success","token"=>$token,"user"=>$user]);
        }

        return response()->json(["status"=>"error","message"=>"Invalid email or password"]);

    }


    public function update(array $request,$id)
    {
        $data = (object)$request;

        $user = $this->user->where('id',$id);
        $user->update([
            'first_name'    => $data->first_name,
            'last_name'     => $data->last_name,
            'email'         => $data->email,
            'phone'         => $data->phone,
            'gender'        =>$data->gender,
            'location'      => $data->location,

        ]);

        if ($user)
            return $request;
        return Response()->json(['status' => 200, 'message' => 'User Successfully Updated !!']);
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
        return response()->json(['status' => 200, 'message' => 'User Successfully Deleted !!']);
    }


}