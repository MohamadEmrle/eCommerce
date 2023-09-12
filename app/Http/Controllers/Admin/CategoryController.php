<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\main\StoreRequest;
use App\Http\Requests\Admin\Categories\main\UpdateRequest;
use App\Http\Requests\Admin\Categories\sub\StoreRequest as SubStoreRequest;
use App\Http\Requests\Admin\Categories\sub\UpdateRequest as SubUpdateRequest;
use App\Http\Traits\imageTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use imageTrait;
    // Start Categories Main
    public function main()
    {
        $categories = Category::whereNull('praent_id')->paginate(12);
        return view('admin.categories.main.index',compact('categories'));
    }
    public function main_create()
    {
        return view('admin.categories.main.create');
    }
    public function main_store(StoreRequest $request)
    {
        $date = $request->all();
        $date['image'] = $this->saveImage($date['image'],'assets/images/categories/main');
        Category::create($date);
        return redirect()->route('admin.categories.main')->with(['succes'=>'Added Category Successfull']);
    }
    public function main_edit($id)
    {
        $record = Category::find($id);
        return view('admin.categories.main.edit',compact('record'));
    }
    public function main_update(UpdateRequest $request , $id)
    {
        $record = Category::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            File::delete('assets/images/categories/main/'.$record->image);
        }
        $data['image'] = $this->saveImage($data['image'],'assets/images/categories/main');
        $record->update($data);
        return redirect()->route('admin.categories.main');
    }
    public function main_active_desactive($id)
    {
        $record = Category::find($id);
        if($record->is_active == 1) {
            $record->update(['is_active' => 0]);
        } elseif($record->is_active == 0) {
            $record->update(['is_active' => 1]);
        }
        return redirect()->back();
    }
    public function main_destroy($id)
    {
        $record = Category::find($id);
        $path = 'assets/images/categories/main/'.$record->image;
        if(File::exists($path)) {
            File::delete($path);
        }
        $record->delete();
        return redirect()->back();
    }
    // End Categories Main

    // Start Categories Sub
    public function sub()
    {
        $categories = Category::whereNotNull('praent_id')->paginate(12);
        return view('admin.categories.sub.index',compact('categories'));
    }
    public function sub_create()
    {
        $categories = Category::whereNull('praent_id')->get();
        return view('admin.categories.sub.create',compact('categories'));
    }
    public function sub_store(SubStoreRequest $request)
    {
        $date = $request->all();
        $date['image'] = $this->saveImage($date['image'],'assets/images/categories/sub');
        Category::create($date);
        return redirect()->route('admin.categories.sub')->with(['succes'=>'Added Category Successfull']);
    }
    public function sub_edit($id)
    {
        $record = Category::find($id);
        $categories = Category::whereNull('praent_id')->get();
        return view('admin.categories.sub.edit',compact('record','categories'));
    }
    public function sub_update(SubUpdateRequest $request , $id)
    {
        $record = Category::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            File::delete('assets/images/categories/sub/'.$record->image);
        }
        $data['image'] = $this->saveImage($data['image'],'assets/images/categories/sub');
        $record->update($data);
        return redirect()->route('admin.categories.sub');
    }
    public function sub_active_desactive($id)
    {
        $record = Category::find($id);
        if($record->is_active == 1) {
            $record->update(['is_active' => 0]);
        } elseif($record->is_active == 0) {
            $record->update(['is_active' => 1]);
        }
        return redirect()->back();
    }
    public function sub_destroy($id)
    {
        $record = Category::find($id);
        $path = 'assets/images/categories/sub/'.$record->image;
        if(File::exists($path)) {
            File::delete($path);
        }
        $record->delete();
        return redirect()->back();
    }
    // End Categories Sub
}
