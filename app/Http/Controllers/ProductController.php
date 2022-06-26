<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{
    protected $limit = 10;

    public function index(){
        $userId = Auth::user()->id;
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
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product-> save();

        return response()->json([
            'status' => 'success',
            'message' => `Product ${$product->name} updated successfully`,
        ], 200);
    }

    public function destroy($id){

        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
