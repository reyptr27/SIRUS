<?php

namespace App\Exports\Audit\Email;

use App\Models\Audit\AuditEmail;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class AuditEmailExport implements FromCollection, WithCustomStartCell, ShouldAutoSize, WithMapping, WithHeadings, WithEvents,WithProperties, WithDrawings, WithColumnWidths
{
    use Exportable;

    protected $index = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AuditEmail::with('lokasi', 'dept')->get();
    }

    public function startCell(): string
    {
        return 'A8';
    }

     public function columnWidths(): array
    {
        return [
            'A' => 5,           
        ];
    }

    public function number(array $index)
    {

        ++$this->index;

    }

    public function map($auditemail): array 
    {
        return[
            ++$this->index,
            $auditemail->nama, 
            $auditemail->email,
            $auditemail->password,
            $auditemail->dept->nama_departemen,
            $auditemail->lokasi->lokasi,
            $auditemail->created_at,   
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Reynaldo-ITSSBY',
            'lastModifiedBy' => 'Reynaldo-ITSSBY',
            'title'          => 'AUDIT EMAIL ITS',
            'description'    => 'Data audit email ITS cabang Surabaya',
            'subject'        => 'AUDIT EMAIL',
            'keywords'       => 'audit,email,its,surabaya',
            'category'       => 'Email',
            'manager'        => 'Reynaldo-ITSSBY',
            'company'        => 'PT. Sinar Roda Utama',
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo SRU');
        $drawing->setPath(public_path('assets/images/sru-logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B2');

        return $drawing;
    }

    public function headings(): array 
    {
        return [
            'NO',
            'Nama',
            'Email',
            'Password',
            'Departemen',
            'Lokasi',
            'Tgl_Dicatat'
        ];
    }

    public function registerEvents(): array 
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A8:G8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'ffffff']
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '0264f7']
                    ],
                ]);
            }
        ];
    }
}
