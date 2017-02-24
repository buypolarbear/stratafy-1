<?php

namespace App\Http\Controllers;

use App\Resolution;
use App\Owner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('resolutions', ['resolutions' => Resolution::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresolution');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $description = $request->get('description');
        try {
            Resolution::add($description, Carbon::now()->addDay());
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect('/resolutions/create')->withInput();
        }
        return redirect('/resolutions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function show(Resolution $resolution, Owner $owner = null)
    {
        $resolution = $resolution->load('owners');
        $owner = $resolution->owners->where('id', $owner ? $owner->id : null)->first();
        return view('showresolution', ['resolution' => $resolution, 'owner' => $owner]);
    }


    /**
     * Store Vote
     *
     * @param  \App\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request, Resolution $resolution, Owner $owner)
    {
        $vote = $request->get('vote');
        try {
            $resolution = $resolution->vote($owner, $vote);
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect('/resolutions/'.$resolution->id.'/vote/'.$owner->id)->withInput();
        }
        $owner = $resolution->owners->where('id', $owner->id)->first();
        return redirect('/resolutions/'.$resolution->id.'/vote/'.$owner->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function edit(Resolution $resolution)
    {
        return view('editresolution', ['resolution' => $resolution]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resolution $resolution)
    {
        $resolution->description = $request->get('description') ?: $resolution->description;
        $resolution->status = $request->get('status') ?: $resolution->status;
        $resolution->expire_at = $request->get('expire_at') ?: $resolution->expire_at;
        $resolution->save();
        return redirect('/resolutions');
    }

}
