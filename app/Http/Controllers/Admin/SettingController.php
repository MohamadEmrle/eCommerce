<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\setting\DeliveryRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function delivery($type)
    {
        return view('admin.setting.delivery',compact('type'));
    }
    public function delivery_store(DeliveryRequest $request)
    {
        $setting = Setting::updateOrCreate([
            'type_number' =>$request->type_number,
            'key'         =>$request->key,
        ], [
            'value'       => $request->value,
        ]);
        if($setting) {
            return redirect()->route('admin.dashboard');
        }
    }
}
