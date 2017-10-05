<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resolution extends Model
{
    protected $guarded = [];
    protected $dates = ['expire_at'];

    public static function add(string $description, Carbon $end_date = null)
    {
        $end_date = $end_date ?: Carbon::now()->addDay();
        if (self::where(['description' => $description])->exists()) {
            throw new \Exception('Resolution already exist for "'.$description.'"');
        }
        $resolution = self::create(['description' => $description, 'expire_at' => $end_date]);
        $resolution->owners()->attach(Owner::all()->pluck('id'));

        return $resolution->load('owners');
    }

    public function owners()
    {
        return $this->belongsToMany('App\Owner', 'ballots', 'resolution_id', 'owner_id')
                    ->withPivot('vote')
                    ->withTimestamps();
    }

    public function vote(Owner $owner, string $vote)
    {
        if ($this->status != 'open' || Carbon::now()->gt($this->expire_at)) {
            throw new \Exception('Resolution is no longer open');
        }
        if (!in_array($vote, ['yay', 'nay', 'abstain'])) {
            throw new \Exception('Vote can only be yay, nay, abstain');
        }
        if (!$this->owners()->where('owner_id', $owner->id)->exists()) {
            throw new \Exception('Owner not part of resolution');
        }
        $this->owners()->updateExistingPivot($owner->id, ['vote' => $vote]);

        return $this->load('owners');
    }

    public function startsWith(string $start)
    {
        return starts_with($this->description, $start);
    }

    public function after(Carbon $after)
    {
        return $this->expire_at->gt($after);
    }
}
