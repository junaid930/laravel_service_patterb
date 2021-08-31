<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title' , 
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    } 
}
