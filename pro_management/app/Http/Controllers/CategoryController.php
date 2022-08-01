<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        //paging
        $category = category::latest()->paginate(5);
        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_desc' => 'required',

        ]);

        product::create($request->all());
        return redirect()->route('categories.index')->with('success',
            'Created Successfully.');
    }

    public function show(category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, category $category)
    {
        $request->validate([
            'category_name' => 'required',
            'category_desc' => 'required',
            'category_qty' => 'required',
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success',
            'Updated Successfully.');
    }


    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success',
            'Student deleted successfully.');
    }
}
