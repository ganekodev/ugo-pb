<?php

namespace App\Exports;

use App\Models\PartnerTraction;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PartnerTractionExport  implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings, WithStrictNullComparison
{
    private string $pb_code;
    public function __construct($pb_code) {
        $this->pb_code = $pb_code;
    }
    public function collection()
    {
        return PartnerTraction::from('partner_tractions')
            ->leftjoin('partners','partners.id','partner_tractions.partner_id')
            ->where('partner_tractions.deleted_at', null)
            ->where('partners.referal_code', $this->pb_code)
            ->select([
                'partners.full_name',
                'partner_tractions.traction_date',
                'partner_tractions.traction_nominal',
                'partner_tractions.traction_type',
            ])->get();
    }
    public function headings(): array
    {
        return [
            'Partner Name',
            'Date',
            'Nominal',
            'Type',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
