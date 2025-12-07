<?php

namespace App\Exports;

use App\Models\PartnerCashflow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PartnerCashflowExport  implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings, WithStrictNullComparison
{
    private string $pb_code;
    public function __construct($pb_code) {
        $this->pb_code = $pb_code;
    }
    public function collection()
    {
        return PartnerCashflow::from('partner_cashflow')
            ->leftjoin('partners','partners.id','partner_cashflow.partner_id')
            ->where('partner_cashflow.deleted_at', null)
            ->where('partners.partner_status', '!=', 'unverified')
            ->where('partners.referal_code', $this->pb_code)
            ->select([
                'partners.full_name',
                'partner_cashflow.total_order',
                'partner_cashflow.total_revenue',
                'partner_cashflow.total_referal_fee',
                'partner_cashflow.total_income',
                'partner_cashflow.total_withdraw',
            ])->get();
    }
    public function headings(): array
    {
        return [
            'Partner Name',
            'Total Order',
            'Total Revenue',
            'Total Referal Fee',
            'Total Income',
            'Total Withdraw',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
