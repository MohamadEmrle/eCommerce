<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\BrandRequest;
use App\Http\Traits\imageTrait;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    use imageTrait;
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(BrandRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->saveImage($request->image,'assets/images/brands');
        Brand::create($data);
        return redirect()->route('admin.brands')->with(['success' => 'Added Successfyll']);
    }
    public function edit($id)
    {
        $record = Brand::find($id);
        return view('admin.brands.edit',compact('record'));
    }
    public function update(BrandRequest $request , $id)
    {
        $record = Brand::find($id);
        $data = $request->all();
        if(request()->hasFile('image')) {
            File::delete('assets/images/brands/'.$record->image);
        }
        if(isset($request->image)) {
            $data['image'] = $this->saveImage($request->image,'assets/images/brands');
        }
        $record->update($data);
        return redirect()->route('admin.brands');
    }
    public function active_desactive($id)
    {
        $record = Brand::find($id);
        if($record->is_active == 1) {
            $record->update(['is_active' => 0]);
        } elseif($record->is_active == 0) {
            $record->update(['is_active' => 1]);
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        $record = Brand::find($id);
        $path = 'assets/images/brands/'.$record->image;
        if(File::exists($path)) {
            File::delete($path);
        }
        $record->delete();
        return redirect()->back();
    }
}
