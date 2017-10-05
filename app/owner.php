<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = [];
    public static function add(string $unit, string $name = null) {
        if (Owner::where(['unit' => $unit])->exists()) {
            throw new \Exception('Owner already exist at unit "'.$unit.'"');
        }
        $owner = Owner::create(['unit' => $unit, 'name' => $name]);
        event(new \App\Events\OwnerWasCreated($owner));
        return $owner;
    }

    public function resolutions() {
        return $this->belongsToMany('App\Resolution', 'ballots', 'owner_id', 'resolution_id')
                    ->withPivot('vote')
                    ->withTimestamps();
    }
}
