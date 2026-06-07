<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'type',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'marks'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
