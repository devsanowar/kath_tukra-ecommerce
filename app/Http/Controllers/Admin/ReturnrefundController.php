<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Returnrefund;
use Illuminate\Http\Request;

class ReturnrefundController extends Controller
{
    public function returnRefund(){
        $returnRefund = Returnrefund::first();
        return view('admin.layouts.pages.return-refund.return_refund',compact('returnRefund'));
    }

    public function update(Request $request, $id){
        $returnRefund = Returnrefund::find($id);
        $returnRefund->content = $request->content;
        $returnRefund->save();

        $toast = Toastr();
        $toast->success('Content updated successfully.');
        return back();
    }
}
