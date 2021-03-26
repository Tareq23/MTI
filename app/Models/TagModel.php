<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use HasFactory;
    protected $table='tags';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(PostModel::class,'post_tag','tag_id','post_id');
    }

}
