<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Participant::all();
    }

    public function headings(): array
    {
        return [
            'Kode Peserta',
            'Nama',
            'Email',
            'Telepon',
            'Tipe Tiket',
            'Status',
            'Tanggal Daftar',
        ];
    }

    public function map($participant): array
    {
        return [
            $participant->participant_code,
            $participant->name,
            $participant->email,
            $participant->phone,
            $participant->ticket_type,
            $participant->status,
            $participant->registration_date?->format('Y-m-d'),
        ];
    }
}