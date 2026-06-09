<?php

namespace App\Exports;

use App\Models\RegisterUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Retrieve the collection of users from the database.
     */
    public function collection()
    {
        return RegisterUser::all();
    }

    /**
     * Define the explicit matching header row for the Excel file.
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'role',
            'created_at'
        ];
    }

    /**
     * Map the database model attributes into row cell rows cleanly.
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->role,
            $user->created_at ? $user->created_at->toDateTimeString() : '',
        ];
    }
}
