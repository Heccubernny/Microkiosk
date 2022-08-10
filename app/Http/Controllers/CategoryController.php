<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller{

    public function index(){
        $userId = Auth::user();
        $categories = Category::where('user_id', $userId)->paginate($this->limit);

        return $categories;
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->meta_title = $request->input('meta_title');
        $category->content = $request->input('content');

        if($category->save()){
            $latestProduct = Category::latest('id')->first();
            $message = 'Product '. $category->name.' created successfully';
            return $this->dataResponse('success', $message, $latestProduct);
        }

        return $this->dataResponse('error', 'error adding product');
    }

    public function show($id){
        $category = Category::where('id', $id)->first();

        return $category;

    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $message = "Category with id ".$category->id." has been updated to a the name ".$category->name." successfully.";

        if(!$category){
            return $this->dataResponse("error", "Category not found");
        }

        $category = new Category();
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->meta_title = $request->input('meta_title');
        $category->content = $request->input('content');

    }

    public function destroy($id){
        $category = Category::find($id);
        $message = 'Category deleted successfully';

        if(!$category){
            return $this->dataResponse('error', 'Category not found');
        }

        return $this->dataResponse('success', $message);
    }
}
