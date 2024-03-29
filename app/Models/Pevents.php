<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pevents extends Model
{
    use HasFactory;

    protected $table = 'personsEvent';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_person',
        'id_church',
        'id_event',
        'date_register'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
