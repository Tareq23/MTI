<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;
    protected $table='messages';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'text','creator_id'
    ];
}
