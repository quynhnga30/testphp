<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //paging
        $products = product::latest()->paginate(5);
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
            'category_id'=>'required'
        ]);

        product::create($request->all());
        return redirect()->route('products.index')->with('success',
            'Created Successfully.');
    }
    public function show(product $product)
    {
        return view('products.show',compact('product'));
    }

    public function edit(product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
            'category_id'=>'required'
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success',
            'Updated Successfully.');
    }

    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success',
            'Student deleted successfully.');
    }
}
?>
