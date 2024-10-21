<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Supply;

class SupplyController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|numeric',
        ]);
        if ($request->has('supplier_id')) {

            if ($request->input('supplier_id') == 'null') {
                $suppliers_id = null;
            } else {
                $suppliers_id = $request->input('supplier_id');
            }
            $supply = Supply::create([
                'suppliers_id' => $suppliers_id,
                'total_price' => 0,
                'created_by' => auth()->user()->id,
                'branch_id' => $request->input('branch_id')
            ]);
        } else {
            $supply = Supply::create([
                'total_price' => 0,
                'created_by' => auth()->user()->id,
                'branch_id' => $request->input('branch_id')
            ]);
        }

        return redirect('/supply?id=' . strval($supply->id));
    }

    public function show(Request $request)
    {
        if ($request->has('branch_id')) {

            $branch_id = $request->input('branch_id');
        } else {

            $branch_id = auth()->user()->branch_id;
        }
        $supply = Supply::where('id', $request->input('id'))
            ->with(['creator', 'supplier', 'payments', 'branch'])
            ->first();

        return view('supply', ['supply' => $supply]);
    }
    public function availableProducts($id, Request $request)
    {
        $supply = Supply::find($id);
        $term = $request->input('term');
        if ($term) {
            if ($supply->suppliers_id)
                $available_products = Product::where('supplier_id', $supply->suppliers_id)
                    ->whereRaw("CONCAT(name, ' ', type) LIKE ?", ["{$term}%"])
                    ->selectRaw("CONCAT(name, ' ', type) as label, CONCAT(name, ' ', type) as value, id")
                    ->limit(100)
                    ->get();
            else
                $available_products = Product::whereRaw("CONCAT(name, ' ', type) LIKE ?", ["{$term}%"])
                    ->selectRaw("CONCAT(name, ' ', type) as label, CONCAT(name, ' ', type) as value, id")
                    ->limit(100)
                    ->get();
        } else {
            if ($supply->suppliers_id)
                $available_products = Product::where('supplier_id', $supply->suppliers_id)
                    ->selectRaw("CONCAT(name, ' ', type) as label, CONCAT(name, ' ', type) as value, id")
                    ->get();
            else
                $available_products = Product::selectRaw("CONCAT(name, ' ', type) as label, CONCAT(name, ' ', type) as value, id")
                    ->get();
        }

        return response()->json($available_products);
    }
    public function all(Request $request)
    {
        if ($request->has('branch_id')) {

            $branch_id = $request->input('branch_id');
        } else {

            $branch_id = auth()->user()->branch_id;
        }
        $supplies = Supply::when($branch_id, function ($query, $branch_id) {
            return $query->where('branch_id', $branch_id);
        })->with(['creator', 'supplier', 'payments', 'branch'])->get();
        $suppliers = Supplier::all();
        $branches = Branch::all();
        return view('supplys', ['suppliers' => $suppliers, 'supplies' => $supplies, 'branches' => $branches]);
    }

    public function addProdToBatch(Request $request)
    {
        $request->validate([
            'supply_id' => 'required|numeric|exists:supplies,id',
            'product_id' => 'required|numeric|exists:products,id',
            'strength_id' => 'required|numeric|exists:product_strengths,id',
            'supplied_quantity' => 'required|numeric',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'expiration_date' => 'required|date_format:Y-m-d',
        ]);
        if ($request->has('branch_id')) {

            $branch_id = $request->input('branch_id');
        } else {

            $branch_id = auth()->user()->branch_id;
        }

        $batch = Batch::create([
            'product_strength_id' => $request->input('strength_id'),
            'supply_id' => $request->input('supply_id'),
            'supplied_quantity' => $request->input('supplied_quantity'),
            'quantity' => $request->input('supplied_quantity'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
            'expiration_date' => $request->input('expiration_date'),
            'branch_id' => $branch_id,
            'created_by' => auth()->user()->id,
        ]);

        // $batch = Batch::where('id', $batch->id)->with(['productStrength', 'supply', 'branch'])->first();
        $batch = Batch::selectRaw('batches.*, products.name AS name, product_strengths.strength as strength, users.name as creator, branches.name as branche')
            ->join('product_strengths', 'batches.product_strength_id', '=', 'product_strengths.id')
            ->join('products', 'product_strengths.product_id', '=', 'products.id')
            ->join('branches', 'batches.branch_id', '=', 'branches.id')
            ->join('users', 'batches.created_by', '=', 'users.id')
            ->where('batches.id', $batch->id)
            ->first();

        return response()->json($batch);
    }
}
