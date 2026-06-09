<?php

namespace App\Imports;

use App\Models\RegisterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Map each row from the Excel file to the RegisterUser Model.
     */
    public function model(array $row)
    {
        return new RegisterUser([
            'name'     => $row['name'],
            'email'    => $row['email'],
            // Hash password safely during import
            'password' => Hash::make($row['password']),
            // Fallback to 'user' if role is empty or malformed
            'role'     => strtolower($row['role'] ?? 'user'),
        ]);
    }

    /**
     * Define validation rules for data within the Excel sheet.
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:register_users,email'],
            'password' => ['required', 'min:6'],
            'role'     => ['required', Rule::in(['user', 'teacher', 'admin'])],
        ];
    }
}
