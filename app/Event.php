<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     protected $fillable = [
        'name', 'time','type','group_id'
    ];

    protected $public = false; 

	 public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function scopeByGroup($query,$groups)
    {        
        foreach ($groups as $group) {
            $group_ids[] = $group->group_id;
        }

        return $query->whereHas('group', function ($q) use($group_ids){
                $q->whereIn('group_id', $group_ids);   
            })->get();
    }
}
