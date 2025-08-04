<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blocklist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BlocklistController extends Controller
{
    public function index()
    {
        $blocklists = Blocklist::latest()->get(['id', 'number']);
        return view('admin.layouts.pages.order.block-list', compact('blocklists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'regex:/^(01[3-9][0-9]{8}|\+8801[3-9][0-9]{8})$/', 'unique:blocklists,number'],
        ]);

        Blocklist::create([
            'number' => $request->number,
        ]);

        return response()->json(['success' => 'Number added to block list.']);
    }

    public function unblock($id)
    {
        $unblock = Blocklist::findOrFail($id);
        $unblock->delete();
        return response()->json(['success' => 'Number Successfully Unblocked.']);
    }
}
