<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use App\Models\CostCategory;
use App\Models\FieldOfCost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index(Request $request)
    {
        $query = Cost::with(['category', 'fieldOfCost'])->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('field_of_cost_id')) {
            $query->where('field_of_cost_id', $request->field_of_cost_id);
        }

        if ($request->filled('spend_by')) {
            $query->where('spend_by', 'like', '%' . $request->spend_by . '%');
        }

        $costs = $query->paginate(20)->withQueryString();
        $all_costs = $costs;
        $cost_categories = CostCategory::all();
        $fields = FieldOfCost::all();

        return view('admin.layouts.pages.cost.index', compact('costs', 'all_costs', 'cost_categories', 'fields'));
    }

    public function create()
    {
        $cost_categories = CostCategory::all();
        $fields = FieldOfCost::all();
        return view('admin.layouts.pages.cost.create', compact('cost_categories', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'             => 'required|date',
            'branch'           => 'nullable|string|max:255',
            'category_id'      => 'required|exists:cost_categories,id',
            'field_of_cost_id' => 'nullable|exists:field_of_costs,id',
            'description'      => 'nullable|string',
            'amount'           => 'required|numeric|min:0',
            'spend_by'         => 'nullable|string|max:255',
        ]);

        Cost::create([
            'date'             => $request->date,
            'branch'           => $request->branch,
            'category_id'      => $request->category_id,
            'field_of_cost_id' => $request->field_of_cost_id,
            'description'      => $request->description,
            'amount'           => $request->amount,
            'spend_by'         => $request->spend_by,
        ]);

        Toastr::success('Cost added successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $cost = Cost::findOrFail($id);
        $cost_categories = CostCategory::all();
        $fields = FieldOfCost::all();
        return view('admin.layouts.pages.cost.edit', compact('cost_categories', 'fields', 'cost'));
    }

    public function detail($id)
    {
        $cost = Cost::findOrFail($id);
        return view('admin.layouts.pages.cost.detail', compact('cost'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date'             => 'required|date',
            'branch'           => 'nullable|string|max:255',
            'category_id'      => 'required|exists:cost_categories,id',
            'field_of_cost_id' => 'nullable|exists:field_of_costs,id',
            'description'      => 'nullable|string',
            'amount'           => 'required|numeric|min:0',
            'spend_by'         => 'nullable|string|max:255',
        ]);

        $cost = Cost::findOrFail($id);

        $cost->update([
            'date'             => $request->date,
            'branch'           => $request->branch,
            'category_id'      => $request->category_id,
            'field_of_cost_id' => $request->field_of_cost_id,
            'description'      => $request->description,
            'amount'           => $request->amount,
            'spend_by'         => $request->spend_by,
        ]);

        Toastr::success('Cost updated successfully.');
        return redirect()->route('cost.index');
    }

    public function destroy()
    {
        return view('admin.layouts.pages.cost.crate');
    }
}
