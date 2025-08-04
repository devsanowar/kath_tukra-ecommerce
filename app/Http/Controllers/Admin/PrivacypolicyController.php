<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacypolicy;
use Illuminate\Http\Request;

class PrivacypolicyController extends Controller
{
    public function privacyPolicy(){
        $privacyPolicy = Privacypolicy::select(['id', 'privacy_policy'])->first();
        return view('admin.layouts.pages.privacy-policy.privacy_policy', compact('privacyPolicy'));
    }

    public function update(Request $request, $id){
        $privacyPolicy = Privacypolicy::find($id);
        $privacyPolicy->privacy_policy = $request->privacy_policy;
        $privacyPolicy->save();

        $toast = Toastr();
        $toast->success('Content updated successfully.');
        return back();
    }
}
