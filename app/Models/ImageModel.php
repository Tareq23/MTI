<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;
    protected $table='images';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['url'];
}
