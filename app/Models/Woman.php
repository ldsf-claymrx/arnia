<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Woman extends Model
{
    use HasFactory;

    protected $table = 'womanAssistance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_person',
        'date_assitance',
        'who_registered'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
