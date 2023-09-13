<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductRequest;
use App\Http\Traits\imageTrait;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use imageTrait;
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }
    public function create()
    {
        $brands = Brand::where('is_active',1)->get();
        return view('admin.products.create',compact('brands'));
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->saveImage($request['image'],'assets/images/products');
        Product::create($data);
        return redirect()->route('admin.products')->with(['success' => 'Added Successfully']);
    }
    public function edit($id)
    {
        $record = Product::find($id);
        $brands = Brand::where('is_active',1)->get();
        return view('admin.products.edit',compact('record','brands'));
    }
    public function update(ProductRequest $request , $id)
    {
        $record = Product::find($id);
        $data = $request->all();
        if(request()->hasFile('image')) {
            File::delete('assets/images/products/'.$record->image);
        }
        if(isset($request->image)) {
            $data['image'] = $this->saveImage($request->image,'assets/images/products');
        }
        $record->update($data);
        return redirect()->route('admin.products');
    }
    public function active_desactive($id)
    {
        $record = Product::find($id);
        if($record->is_active == 1) {
            $record->update(['is_active' => 0]);
        } elseif($record->is_active == 0) {
            $record->update(['is_active' => 1]);
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        $record = Product::find($id);
        $path = 'assets/images/products/'.$record->image;
        if(File::exists($path)) {
            File::delete($path);
        }
        $record->forceDelete();
        return redirect()->back();
    }
}
