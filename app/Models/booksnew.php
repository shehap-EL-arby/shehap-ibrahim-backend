<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booksnew extends Model
{
    use HasFactory;
    protected $fillable = [
        "id", "image", "description" , "title" ,"price"
     ];
}
