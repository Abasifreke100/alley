<?php
namespace Alley\Modules\Vendor\Api\v1\Repositories;


use Alley\Modules\Account\Models\User;
use Alley\Modules\BaseRepository;
use Alley\Modules\Vendor\Models\Product;
use Alley\Modules\Vendor\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ProductRepository extends BaseRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product=$product;
    }

    public function getAllProduct()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        $product = $this->product->findOrFail($id);
        $getPhoto = ProductImage::where('product_id',$id)->select('filename');
        $photo[] = $getPhoto;
        return $product;
    }

    public function createProduct(array $productData)
    {
        $data = (object) $productData;


        $user = User::where('role','vendor')->first();
        $id = $this->generateUuid();
        $product = Product::create([
            'id' => $id,
            'description'=>$data->description,
            'category'   =>$data->category,
            'street'     =>$data->street,
            'city'       =>$data->city,
            'state'      =>$data->state,
            'feature'    =>$data->feature,
            'role'       =>$user->role,
            'vendor_id'  =>$user->id,
            'price'      =>$data->price,
        ]);
            if($product){
                $this->uploadProductImages($productData['filename'],$product->id);
                return $product;
            }
    }

    private function uploadProductImages(array $images,$productId)
    {
        collect($images)->each(function (UploadedFile $images)use($productId){
            $filename = 'product_photo' . time().'.'.$images->getClientOriginalExtension();// rename each productPhoto uploaded
            Storage::disk('public')->put($filename, File::get($images),'public');//storage directory
            $file = public_path('productImages/'.$filename);//

            ProductImage::create([
                'id'=>$this->generateUuid(),
                'product_id'=> $productId,
                'filename'=>$filename,
            ]);

            if (file_exists($file)){
                $image = Image::make($file);
                $image->resize(100,100,function ($constraints){
                    $constraints->aspectRatio();
                });
                $image->save();
            }

        });
    }


    public function updateProduct(array $request,$id)
    {
        $data = (object) $request;

        $product = $this->product->findOrFail($id);
        $product->update([
            'description'=>$data->description,
            'category'=>$data->category,
            'street'=>$data->street,
            'city'=>$data->city,
            'state'=>$data->state,
            'feature'=>$data->feature,
            'price'=>$data->price,
        ]);
        if ($product){
            return response()->json(['status'=>200],['message'=>'Product Successfully Updated !!']);
        }
        return false;
    }

    public function deleteProduct($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return response()->json(['status'=>200],['message'=>'Product Successfully Deleted !!']);
    }


}