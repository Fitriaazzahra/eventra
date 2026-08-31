<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\Event;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $defaultEventId = Event::first()?->id ?? 1;

        return new Participant([
            'participant_code'  => 'PRT-' . strtoupper(Str::random(6)),
            'name'              => $row['nama'],
            'email'             => $row['email'],
            'phone'             => $row['telepon'] ?? null,
            'event_id'          => $row['event_id'] ?? $defaultEventId,
            'ticket_type'       => $row['tipe_tiket'] ?? 'Regular',
            'registration_date' => $row['tanggal_daftar'] ?? now(),
            'status'            => $row['status'] ?? 'registered',
        ]);
    }
}