<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'contacts';

    protected $fillable = [
        'contact_name',
        'contact_company',
        'contact_phone',
        'email',
        'postedBy',
    ];
}
