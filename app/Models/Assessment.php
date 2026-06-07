<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'subject',
        'description',
        'assessment_date',
        'duration',
        'total_marks'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
