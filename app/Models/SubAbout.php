<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAbout extends Model
{
    use HasFactory;

    protected $fillable = ['postabouts_id','title','link','content', 'users_id'];

    public function users(){

        return $this->belongsTo(User::class)->select('id','name');

    }

    public function postabouts(){

        return $this->belongsTo(PostAbout::class)->select('id','title');

    }
}
