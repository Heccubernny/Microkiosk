<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{
    protected $limit = 10;

    public function index(){
        $userId = Auth::user();
        $products = Product::where('user_id', $userId)->paginate($this->limit);
        return response()->json([
            'status' => 'success',
            'data' => $products->items(),
            'pagination' => [
                'total' => $products->total(),
                'pre_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
                ]
        ], 200);

        echo '<pre>';
            var_dump($userId);
        echo '</pre>';
        exit;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if($product->save()){
            $latestProduct = Product::latest('id')->first();
            $message = 'Product '. $product->name.' created successfully';
            return $this->dataResponse('success', $message, $latestProduct);
        }

        return $this->dataResponse('error', 'error adding product');

    }

    public function show($id){
        $product = Product::with('user')->where('id', $id)->first();
        if(!$product){
            return $this->dataResponse('error', 'Product not found');
        }
        return $this->dataResponse('success',$product, 200);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $message = 'Product '.$product->name.' updated successfully';
        if(!$product){
            return $this->dataResponse('error', 'Product not found');
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();
        return $this->dataResponse('success', $message, $product);
    }

    public function destroy($id){

        $product = Product::find($id);
        $message = 'Product deleted successfully';

        if(!$product){
            return $this->dataResponse('error', 'Product not found');
        }

        return $this->dataResponse('success', $message);
    }
}
