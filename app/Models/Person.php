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
        'birthdate',
        'category',
        'sex',
        'civil_status',
        'address',
        'phone_number',
        'facebook',
        'email',
        'personal_invitation',
        'media',
        'do_you_congregate',
        'reminders',
        'who_registered',
        'date_register'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
