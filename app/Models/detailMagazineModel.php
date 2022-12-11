<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailMagazineModel extends Model
{
    use HasFactory;
    protected $table = 'magazine-detail';
    protected $primaryKey = "id";
    protected $fillable  = [
        'magazine_id',
        'img_file',
        'page',
    ];
}
