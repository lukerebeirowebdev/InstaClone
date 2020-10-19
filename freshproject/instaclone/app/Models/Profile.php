<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
       return ($this->image) ? '/storage/'.$this->image : '/storage/user_default_avatar.png';
    }

    public function getURLAttribute()
    {
        return route('profile.show', $this->user_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
