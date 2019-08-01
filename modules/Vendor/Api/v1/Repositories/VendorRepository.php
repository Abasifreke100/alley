<?php
namespace Alley\Modules\Vendor\Api\v1\Repositories;


use Alley\Modules\Vendor\Models\Product;
use Illuminate\Support\Facades\Hash;
use Alley\Modules\Vendor\Api\v1\Transformers\VendorTransformer;
use Alley\Modules\Vendor\Models\Vendor;
use Alley\Modules\BaseRepository;

class VendorRepository extends BaseRepository
{
    private $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor=$vendor;
    }


    public function index()
    {
        return Vendor::all();

    }

    public function getById($id)
    {
        $vendor = $this->vendor->where('id',$id)->firstOrFail();
        return $vendor;
    }

    public function register(array $vendorData)
    {
        $data = (object) $vendorData;

        $vendor = Vendor::create([
            'id'               =>$this->generateUuid(),
            'vendor_name'      =>$data->vendor_name,
            'phone_number'     =>$data->phone_number,
            'location'         =>$data->location,
            'email'            =>$data->email,
            'password'         =>Hash::make($data->password)
        ]);

        if ($vendor){
            return $this->login($vendorData);
        }
        return false;
    }

    public function login(array $data){
        $credentials = collect($data)->only(['email','password']);
        if($token = auth()->attempt($credentials->toArray())){
            $vendor = auth()->vendor();
            $vendor = fractal($vendor, new VendorTransformer())->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
            return response()->json(["status"=>"success","token"=>$token,"vendor"=>$vendor]);
        }

        return response()->json(["status"=>"error","message"=>"Invalid email or password"]);

    }

    public function update(array $request,$id)
    {
        $data = (object) $request;

        $vendor = $this->vendor->findOrFail($id);
        $vendor->update([
            'vendor_name'   =>$data->vendor_name,
            'phone_number'  =>$data->phone_number,
            'location'      =>$data->location,
            'email'         =>$data->email,
            'password'      =>$data->password,
        ]);

        if ($vendor){
            return $request;
        }
        return Response()->json(['status'=>200],['message'=>'Vendor Updated Successfully !!']);
    }

    public function delete($id)
    {
        $vendor = $this->vendor->findOrFail($id);
        $vendor->delete();
        return response()->json(['status'=>200],['message'=>'Vendor Deleted Successfully !!']);
    }

}