<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantsImport;
use App\Exports\ParticipantsExport;

class ImportController extends Controller
{
    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ParticipantsImport, $request->file('file'));

        return back()->with('success', app()->getLocale() === 'id' ? 'Data berhasil diimpor!' : 'Data imported successfully!');
    }

    public function export()
    {
        return Excel::download(new ParticipantsExport, 'data-peserta.xlsx');
    }
}