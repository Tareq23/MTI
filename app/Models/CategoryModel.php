<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function post()
    {
        return $this->belongsTo(PostModel::class);
    }
    public function posts()
    {
        return $this->hasMany(PostModel::class,'category_id','id');
    }
}
