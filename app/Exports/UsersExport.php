<?php

namespace App\Exports;

use App\Models\RegisterUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    protected $role;

    // Receive the filter value from the controller configuration
    public function __construct($role = null)
    {
        $this->role = $role;
    }

    /**
     * Construct database query scoped to chosen user criteria.
     */
    public function query()
    {
        $query = RegisterUser::query();

        // If a specific legitimate role filter is applied, query only that data group
        if ($this->role && in_array($this->role, ['user', 'teacher', 'admin'])) {
            $query->where('role', $this->role);
        }

        return $query;
    }

    /**
     * Table headings design setup structure.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email Address',
            'Assigned Role',
            'Created At'
        ];
    }

    /**
     * Define the data map per single object item iteration.
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            ucfirst($user->role), // Capitalize role word
            $user->created_at->toDateTimeString(),
        ];
    }
}
