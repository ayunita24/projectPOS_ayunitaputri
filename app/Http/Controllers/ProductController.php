<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index()
    {
        $product=Product::all();
        return view('product.index',[

            "title"=>"Product",
            "data"=>$product
        ]);
    }
    public function create():View
    {
        return view('product.create')->with([
            "title"=>"Tambah Data Product",
            "data"=>Category::all()
        ]);
    }
    public function store(Request $request):RedirectResponse
{
    $request->validate([
        "name"=>"required",
        "description"=>"nullable",
        "stock"=>"required",
        "price"=>"required",
        "category_id"=>"required"
    ]);

    product::create($request->all());
    return redirect()->route('produk.index')->with('succes','Data Produk Berhasil Ditambahkan');
}
public function edit(product $produk ):View
{
    return view('product.edit',compact('produk'))->with([
        "title"=>"Ubah Data Produk",
        "data"=>Category::all()
    ]);
}
public function update(Product $produk,Request $request):RedirectResponse
{
    $request->validate([
        "name"=>"required",
        "description"=>"nullable",
        "stock"=>"required",
        "price"=>"required",
        "category_id"=>"required"
    ]);
     
    $produk->update($request->all());
    return redirect()->route('produk.index')->with('updated','Data Produk Berhasil Diubah');
}
public function show():View
{
    $product=Product::all();
    return view('product.show')->with([
        "title"=>"Tampil Data Produk",
        "data"=>$product
    ]);
}
public function destroy($id):RedirectResponse
{
    Product::where('id',$id)->delete();
    return redirect()->route('produk.index')->with('deleted','Data Produk Behasil Dihapus');
}
    }

