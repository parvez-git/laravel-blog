<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function create()
    {
      $categories = Category::all();

      return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'title'   => 'required|min:3|max:500',
          'slug'    => 'required|min:3|max:500',
      ]);

      Category::create($request->all());

      return back();
    }

    public function edit($id)
    {
      $category = Category::find($id);

      return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'title'   => 'required|min:3|max:500',
          'slug'    => 'required|min:3|max:500',
      ]);

      $category = Category::find($id);
      $category->update($request->all());

      return redirect()->route('category.create');
    }

    public function destroy($id)
    {
      Category::find($id)->delete();

      return back();
    }
}
