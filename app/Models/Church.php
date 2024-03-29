<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $table = 'churchs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'name_pastor',
        'denomination'
    ];

    protected $guarded = [];
    public $timestamps = false;
}
