<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Category;
Use App\Tag;
Use App\Post;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts)->with('categories', $categories)->with('tags', $tags);
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
            'categoryname' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->input('categoryname');
        $category->save();

        return redirect('/dashboard')->with('success', 'Category added!');
    }

    public function updateCategory(Request $request)
    {
         $this->validate($request, [
            'updatename' => 'required'
        ]);
        $category = Category::find($request->id);
        $category->name = $request->input('updatename');
        $category->save();

        return redirect('/dashboard')->with('success', 'Category updated!');
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return redirect('/dashboard')->with('success', 'Category deleted!');
    }

    public function storeTag(Request $request)
    {
        $this->validate($request, [
            'tagname' => 'required'
        ]);
        $tag = new Tag;
        $tag->name = $request->tagname;
        $tag->save();
        return redirect('/dashboard')->with('success', 'Tag added!');
    }

    public function updateTag(Request $request)
    {
        $this->validate($request, [
            'updatetagname' => 'required'
        ]);
        $tag = Tag::find($request->id);
        $tag->name = $request->input('updatetagname');
        $tag->save();

        return redirect('/dashboard')->with('success', 'Tag updated!');
    }

    public function deleteTag(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
        return redirect('/dashboard')->with('success', 'Tag deleted!');
    }
}
