<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'lastname',
        'phone_number',
        'email',
        'address',
        'sex',
        'birthdate',
        'nickname',
        'who_registered',
        'id_category',
        'date_register'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
