<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listjob extends Model
{
    use HasFactory;
    protected $table = 'listjobs';

    protected $fillable = [
        'id',
        'jobname',
        'company_email',
        'location',
        'job_description'
    ];
}
