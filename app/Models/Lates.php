<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lates extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time_late',
        'information',
        'bukti',
        'student_id'
    ];

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

}
