<?php
namespace Alley\Modules\Admin\Api\v1\Repositories;


use Illuminate\Support\Facades\Hash;
use Alley\Modules\Admin\Api\v1\Transformers\AdminTransformer;
use Alley\Modules\Admin\Models\Admin;
use Alley\Modules\BaseRepository;

class AdminRepository extends BaseRepository
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }

    public function index()
    {
        return Admin::all();
    }

    public function getById($id)
    {
        $admin = $this->admin->findOrFail($id);

        return $admin;
    }

    public function register(array $adminData)
    {
        $data = (object) $adminData;

        $admin = Admin::create([
            'id'=>$this->generateUuid(),
            'first_name'=>$data->first_name,
            'last_name'=>$data->last_name,
            'phone_number'=>$data->phone_number,
            'email'=>$data->email,
            'password'=>Hash::make($data->password),
        ]);

        if ($admin){
            return $this->login($adminData);
        }
        return false;

    }

    public function login(array $data){
        $credentials = collect($data)->only(['email','password']);
        if($token = auth()->attempt($credentials->toArray())){
            $admin = auth()->admin();
            $admin = fractal($admin, new AdminTransformer())->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
            return response()->json(["status"=>"success","token"=>$token,"admin"=>$admin]);
        }

        return response()->json(["status"=>"error","message"=>"Invalid email or password"]);

    }

    public function update(array $request,$id)
    {
        $data = (object) $request;

        $admin = $this->admin->where('id',$id);
         $admin->update([
             'first_name'=>$data->first_name,
             'last_name' =>$data->last_name,
             'phone_number' =>$data->phone_number,
             'email' =>$data->email,
             'password'=>$data->password,
         ]);

         if ($admin){
             return $request;
         }
         return Response()->json(['status'=>200],['message'=>'Admin Successfully Updated !!']);
    }

    public function delete($id)
    {
        $admin = $this->admin->findOrFail($id);
        $admin->delete();
        return response()->json(['status'=>200],['message'=>'Admin Successfully Deleted !!']);
    }

}