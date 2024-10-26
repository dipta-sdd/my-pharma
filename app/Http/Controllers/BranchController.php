<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchController extends Controller
{
    //

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'contact_info' => ['required', 'numeric', 'digits_between:11,14'],
        ]);

        $branch = Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        return redirect('/branches');
    }
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'contact_info' => ['required', 'numeric', 'digits_between:11,14'],
        ]);

        $data['updated_by'] = auth()->user()->id;
        $branch = Branch::where('id', $id)->first();
        $branch->update($data);
        return response()->json($branch);
    }

    public function allBranch(Request $request)
    {
        $branches = Branch::selectRaw('branches.*, c.name as createdBy, u.name as updatedBy')
            ->join('users as c', 'branches.created_by', '=', 'c.id')
            ->join('users as u', 'branches.updated_by', '=', 'u.id')
            ->get();
        return view('branches', ['branches' => $branches]);
    }
}