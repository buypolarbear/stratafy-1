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
        return Owner::create(['unit' => $unit, 'name' => $name]);
    }

    public function resolutions() {
        return $this->belongsToMany('App\Resolution', 'ballots', 'owner_id', 'resolution_id')
                    ->withPivot('vote')
                    ->withTimestamps();
    }
}
