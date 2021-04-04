<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PostModifiedEvent;
use App\Events\PostCreateEvent;
class PostModel extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'user_id','category_id','tag_id','title','slug','content','time'
    ];
   
    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
    public function category()
    {
        return $this->hasOne(CategoryModel::class,'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(TagModel::class, 'post_tag', 'post_id', 'tag_id');
    }
    public function categories()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
