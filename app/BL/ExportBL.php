<?php

namespace App\BL;

use App\Models\Period;
use App\Enums\SaveResult;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBL implements FromView
{
    public function view(): View
    {
        $data = [];
        $periodId = Period::where('active', true)->first();
        $result = ReportsBL::studentsReport($data);
        $projects = $result->get();
        
        return view('exports.students', [
            'projects' => $projects,
            'periodId' => $periodId
        ]);
    }
}