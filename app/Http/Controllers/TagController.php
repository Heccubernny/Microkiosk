<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TagController extends Controller
{
    //
    public function index(){
        $userId = Auth::user()->id;
        $tags = Tag::where('user_id', $userId)->paginate($this->limit);

        return $tags;
    }

    public function store(Request $request)
    {
        $tags = new Tag();
        $tags->title = $request->input('title');
        $tags->slug = $request->input('slug');
        $tags->meta_title = $request->input('meta_title');
        $tags->content = $request->input('content');

        if($tags->save()){
            $latestProduct = Tag::latest('id')->first();
            $message = 'Product '. $tags->name.' created successfully';
            return $this->dataResponse('success', $message, $latestProduct);
        }

        return $this->dataResponse('error', 'error adding product');
    }

    public function show($id){
        $tags = Tag::where('id', $id)->first();

        return $tags;

    }

    public function update(Request $request, $id)
    {
        $tags = Tag::find($id);
        $message = "tags with id ".$tags->id." has been updated to a the name ".$tags->name." successfully.";

        if(!$tags){
            return $this->dataResponse("error", "tags not found");
        }

        $tags = new Tag();
        $tags->title = $request->input('title');
        $tags->slug = $request->input('slug');
        $tags->meta_title = $request->input('meta_title');
        $tags->content = $request->input('content');

    }

    public function destroy($id){
        $tags = Tag::find($id);
        $message = 'tags deleted successfully';

        if(!$tags){
            return $this->dataResponse('error', 'tags not found');
        }

        return $this->dataResponse('success', $message);
    }
}
