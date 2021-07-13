<?php

namespace App\Exports;

use App\Models\Participante;
use App\Models\Period;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApprovedStudents implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        return view('reports.ExcelReportApprovedStudents', [
            'participante' => Participante::all()
        ]);
    }
}
