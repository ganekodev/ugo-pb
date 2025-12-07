<?php

namespace App\Exports;

use App\Models\Partner;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PartnerVerifiedExport  implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings
{
    private string $pb_code;
    public function __construct($pb_code) {
        $this->pb_code = $pb_code;
    }
    public function collection()
    {
        return Partner::where('partners.deleted_by', null)->where('partner_status', '!=', 'unverified')
        ->where('referal_code', $this->pb_code)
        ->select([
            'first_name',
            'last_name',
            'full_name',
            'pb_code',
            'referal_code',
            'category_type',
            'package_type',
            'partner_status',
            'phone_number',
            'email',
            'born_place',
            'bod',
            'religion',
            'graduate',
            'ktp_address',
            'register_areas',
        ])->get();
    }
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Full Name',
            'PB Code',
            'Referal Code',
            'Category Type',
            'Package Type',
            'Partner Status',
            'Phone Number',
            'Email',
            'Born Place',
            'BOD',
            'Religion',
            'Graduate',
            'KTP Address',
            'Register Areas',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:P1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
