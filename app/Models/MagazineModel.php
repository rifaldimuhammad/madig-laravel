<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineModel extends Model
{
    use HasFactory;
    protected $table = 'magazine';
    protected $primaryKey = "id";
    protected $fillable  = [
        'title',
        'cover',
        'description',
        'pdf_file'
    ];
}
