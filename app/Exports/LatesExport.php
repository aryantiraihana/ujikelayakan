<?php

namespace App\Exports;

use App\Models\Lates;
use App\Models\Rayon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class LatesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->role == 'admin') {
            return Lates::with('students')
                ->select('student_id', DB::raw('count(*) as total'))
                ->groupBy('student_id')
                ->get();
        } elseif (Auth::user()->role == 'ps') {
            $rayon = Rayon::where('user_id', Auth::user()->id)->first();
            return Lates::with('students')
                ->select('student_id', DB::raw('count(*) as total'))
                ->groupBy('student_id')
                ->where('student_id', $rayon->id)
                ->get();
        }

        return collect(); 
    }

    public function headings(): array
    {
        return [
            "NIS", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($lates): array
    {
        $students = $lates->students;

        return [
            $students->nis,
            $students->name,
            $students->rombel->rombel,
            $students->rayon->rayon,
            $lates->total,
        ];
    }
}
