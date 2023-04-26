<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping, WithColumnFormatting
{

    public function __construct(
        public string $startdate,
        public string $enddate
    )
    {
        //
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => [
                'bold' => true,
                'size' => 16
                ]]
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'nome',
            'email',
            'data de verificação',
            'data de criação',
            'data de atualização'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->email_verified_at ? Date::dateTimeToExcel($user->email_verified_at) : null,
            $user->created_at ? Date::dateTimeToExcel($user->created_at) : null,
            $user->updated_at ? Date::dateTimeToExcel($user->updated_at) : null,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
    
    public function collection()
    {
        return User::whereBetween('created_at', [$this->startdate, $this->enddate])->get();
    }
}
