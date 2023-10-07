<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftaranDataExport implements FromCollection, WithHeadings
{
    protected $pendaftaran;
    protected $headings;
    public $timestamps = false;

    public function __construct(array $pendaftaran, array $headings)
    {
        $this->pendaftaran = $pendaftaran;
        $this->headings = $headings;
    }

    public function collection()
    {
        return Pendaftaran::all();
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
