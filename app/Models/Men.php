<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Men extends Model
{
    use HasFactory;

    protected $table = 'menAssistance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_person',
        'date_assitance',
        'who_registered'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
