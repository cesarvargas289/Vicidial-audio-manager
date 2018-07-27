<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign_User extends Model
{
    protected $table = 'campaign_user';
    protected $fillable =['campaign_id','user_id'];
}
