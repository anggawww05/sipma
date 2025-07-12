<?php

namespace App\Exports;

use App\Models\Submission;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;

class submissionExport implements FromCollection, WithHeadings, WithColumnWidths, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $search = request('search');
        $startDate = request('start_date');
        $endDate = request('end_date');

        $submissions = Submission::with(['user', 'category'])
            ->when(auth()->user()->operator, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('name', auth()->user()->operator->type);
                });
            })->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ticket_number', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('available', 'like', "%{$search}%");
                });
            })->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]);
            })->get();

        return $submissions->map(function ($submission) {
            return [
                $submission->user->username ?? '-',
                $submission->category->name ?? '-',
                $submission->ticket_number,
                $submission->title,
                $submission->description,
                $submission->status,
                $submission->available,
                $submission->survey ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ["Mahasiswa", "Kategori", "Tiket", "Judul", "Deskripsi", "Status", "Status Publish", "Survey"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
        ];

    }
    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $cellRange = 'A1:H' . $event->sheet->getHighestRow();

                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('A1:H1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFCCE5FF'],
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
