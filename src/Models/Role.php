<?php

namespace PEAVEL\Pilot\Models;

use Illuminate\Database\Eloquent\Model;
use PEAVEL\Pilot\Facades\Pilot;

class Role extends Model
{
    protected $guarded = [];

    public function users()
    {
        $userModel = Pilot::modelClass('User');

        return $this->belongsToMany($userModel, 'user_roles')
                    ->select(app($userModel)->getTable().'.*')
                    ->union($this->hasMany($userModel))->getQuery();
    }

    public function permissions()
    {
        return $this->belongsToMany(Pilot::modelClass('Permission'));
    }
}
