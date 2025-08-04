<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Termscondition;
use Illuminate\Http\Request;

class TermsAdnCondiotnController extends Controller
{
    public function termsAndCondition(){
        $termsAndCondtion = Termscondition::first();
        return view('admin.layouts.pages.terms-condition.terms_and_condition', compact('termsAndCondtion'));
    }

    public function update(Request $request, $id){
        $termsAndCondtion = Termscondition::find($id);
        $termsAndCondtion->content = $request->content;
        $termsAndCondtion->save();

        $toast = Toastr();
        $toast->success('Content updated successfully.');
        return back();
    }
}
