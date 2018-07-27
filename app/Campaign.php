<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this
            ->belongsToMany('App\User', 'campaign_user', 'campaign_id', 'user_id')
            ->withTimestamps();
    }
}
