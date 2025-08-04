<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ManageMenuItem;
use App\Http\Controllers\Controller;

class PrivilegeController extends Controller
{
    public function privilege(){
        $menuStatus = ManageMenuItem::first();
        return view('admin.super-admin.privilege', compact('menuStatus'));
    }

    public function update(Request $request){
        $updateSideMenu = ManageMenuItem::first();
        $updateSideMenu->update([
            'category_status' => $request->has('category_status') ? 1 : 0,
            'subcategory_status' => $request->has('subcategory_status') ? 1 : 0,
            'brand_status' => $request->has('brand_status') ? 1 : 0,
            'website_color_status' => $request->has('website_color_status') ? 1 : 0,
            'user_status' => $request->has('user_status') ? 1 : 0,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Privileges updated successfully!']);
    }
}
