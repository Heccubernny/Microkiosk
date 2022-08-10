<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller{

    public function index(){
        $userId = Auth::user();
        $cart_items = Cart::with('Items')->where('user_id', $userId)->get();
        $cart_total = Cart::where('user_id', $userId)->sum('total');

        if (!$cart_items) {
            $message = 'Cart is empty';
            return $this->dataResponse('error', $message);
        }

        $data = [
            'cart_items' => $cart_items,
            'cart_total' => $cart_total,
        ];
        return $this->dataResponse('success', $data);


    }

    public function create(){
        return response(new Cart());
    }

    public function store(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::user();
            $cart = new Cart();
            $cart->user_id = $userId->id;
            $cart->product_qty = $request->get('product_qty');
            $product = Product::find($request->get('product_id'));
            $cart->total = $product->price * $cart->product_qty;
            $count = Cart::where('user_id', $userId->id)->count();
            $cart->save();
            $message = 'Cart created successfully';
            if($count){
                $message = 'item already in your cart';
                return $this->dataResponse('error', $message);
            }
            else if ($count == 0) {
                $message = "cart is empty";
                $cart->update(['is_default' => 1]);
                return $this->dataResponse('error', $message);
            }

            Cart::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'product_qty' => $cart->product_qty,
                'total' => $cart->total,
                ])

            return $this->dataResponse('success', $message);
        }

    }

    public function show($id){
        $cartitem = Cart::where('user_id', $id);
        return $cartitems
    }

    public function update(Request $request, $id)
    {
        if (Cart::update($request->id)) {
            $cartArray = ['quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ], ];
        }

    }

    public function clear(){
        if(Cart::clear()){
            return redirect()->action('${App\Http\Controllers\CartController@index}', ['success_msg' => 'Cart Clear successfully']);
        }

    }

    public function remove(Request $request){
        if(Cart::remove($request->id))
        {
            return redirect()->action('${App\Http\Controllers\CartController@index}', ['success_msg' => 'Cart Clear successfully']);
        }
    }

    public function destroy($id){
        $cart = Cart::find($id)->delete();
        $message = 'Cart deleted successfully';

        if(!$cart){
            return $this->dataResponse('error', 'Cart not found');
        }
        return $this->dataResponse('success', $message);
    }
}
