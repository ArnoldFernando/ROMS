<?php

namespace App\Exports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class FilesByFolderExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $folderId;

    public function __construct($folderId)
    {
        $this->folderId = $folderId;
    }

    public function collection()
    {
        return File::with(['folder', 'user'])
            ->where('folder_id', $this->folderId)
            ->get();
    }

    public function headings(): array
    {
        return [
            // 'ID',
            'Document Code',
            'Subject',
            'Originating Office',
            'Remarks',
            // 'File Path',
            'Date',
            'Folder',
            'Uploaded By',
            'Created At',
        ];
    }

    public function map($file): array
    {
        return [
            // $file->id,
            $file->document_code,
            $file->subject,
            $file->originating_office,
            $file->remarks,
            // $file->file,
            $file->date,
            optional($file->folder)->name,
            optional($file->user)->name,
            $file->created_at->format('F d, Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4CAF50']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
