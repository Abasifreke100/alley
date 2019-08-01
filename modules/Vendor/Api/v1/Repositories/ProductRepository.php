<?php
namespace Alley\Modules\Vendor\Api\v1\Repositories;


use Alley\Modules\Vendor\Models\Product;
use Alley\Modules\BaseRepository;

class ProductRepository extends BaseRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product=$product;
    }

    public function index()
    {
        return Product::all();
    }

    public function getById($id)
    {
        $product = $this->product->findOrFail($id);

        return $product;
    }

    public function upload(array $productData)
    {
        $data = (object) $productData;

        $product = Product::create([
            'id' => $this->generateUuid(),
            'images'=>$data->images,
            'names'=>$data->names,
            'category'=>$data->category,
            'location'=>$data->location,
            'monthly_price'=>$data->monthly_price,
        ]);

        if($product){
            return response()->json(['status'=>200],['message'=>'Product Successfully Created !!']);
        }
        return false;
    }


    public function update(array $request,$id)
    {
        $data = (object) $request;

        $product = $this->product->findOrFail($id);
        $product->update([
            'images'=>$data->images,
            'names'=>$data->names,
            'category'=>$data->category,
            'location'=>$data->location,
            'monthly_price'=>$data->monthly_price,
        ]);
        if ($product){
            return response()->json(['status'=>200],['message'=>'Product Successfully Updated !!']);
        }
        return false;
    }

    public function delete($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return response()->json(['status'=>200],['message'=>'Product Successfully Deleted !!']);
    }
}