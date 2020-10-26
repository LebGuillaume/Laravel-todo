<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'name', 'description', 'done'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
    /**
     * Get user affected to this todo
     * */
    public function todoAffectedTo()
    {
        return $this->belongsTo('App\User', 'affectedTo_id');

    }


    public function todoAffectedBy()
    {
        return $this->belongsTo('App\User', 'affectedBy_id');

    }



}
