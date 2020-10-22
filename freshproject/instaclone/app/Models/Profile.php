<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {

        $imagePath = ($this->image) ? $this->image : 'profile/VXynstnBiY6b4gn3KtSZ5sXiAlPCh0opaWK7M55H.png';
        return '/storage/' . $imagePath;
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
