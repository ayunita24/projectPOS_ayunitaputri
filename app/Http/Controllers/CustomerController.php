<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;



class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('customer.tabel',[
            "title"=>"Customer",
            "data"=>Customer::all()
        ]);
    }
    public function create():View
    {
        return view('customer.tambah')->with (["title"=>"Tambah Data Custoomer"]);
    }
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"required",
        ]);
        Customer::create($request->all());
        return redirect()->route('pelanggan.index')->with('succes','Data Customer Berhasil Ditambahkan');
    }
    public function edit(Customer $pelanggan):View
    {
        return view('customer.edit',compact('pelanggan'))->with(["title"=>"Ubah Data Customer"]);
    }
    public function update(Request $request,Customer $pelanggan):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"required",
        ]);
        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')
                       ->with('updated','Data Pelanggan Berhasil Diubah');
    }
    public function show(Customer $pelanggan):View
    {
        return view('customer.tampil',compact('pelanggan'))
                    ->with(["title"=> "Data Customer"]);
    }
}
