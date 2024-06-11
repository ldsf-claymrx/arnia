<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Young extends Model
{
    use HasFactory;

    protected $table = 'youthAssistance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_person',
        'date_assitance',
        'who_registered'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
