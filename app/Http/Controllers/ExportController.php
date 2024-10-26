<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function branchExport(Request $request)
    {
        $branches = Branch::selectRaw('branches.*, c.name as createdBy, u.name as updatedBy')
            ->join('users as c', 'branches.created_by', '=', 'c.id')
            ->join('users as u', 'branches.updated_by', '=', 'u.id')
            ->get();

        // Create a new class dynamically (using an anonymous class)
        $export = new class($branches) implements FromCollection, WithHeadings {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function collection()
            {
                return $this->data;
            }
            public function headings(): array
            {
                return [
                    'ID',
                    'Name',
                    'Address',
                    'Contact Info',
                    'Created By',
                    'Updated By',
                    'Created At',
                    'Updated At'
                ];
            }
        };
        return Excel::download($export, 'branches.xlsx');
        return $excelFile;
    }
}