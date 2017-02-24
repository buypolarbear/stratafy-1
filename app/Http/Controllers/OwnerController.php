<?php

namespace App\Http\Controllers;

use Log;
use App\Owner;
use App\Resolution;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    /**
     * Display a listing of the resolutions.
     *
     * @return \Illuminate\Http\Response
     */
    public function resolutions(Request $request)
    {
        $owner = Owner::where('unit', $request->get('unit'))->with('resolutions')->first();
        $resolutions = $owner ? $owner->resolutions : collect();
        return view('welcome', ['resolutions' => $resolutions, 'owner' => $owner]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owners', ['owners' => Owner::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addowner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit = $request->get('unit');
        $name = $request->get('name');
        try {
            $owner = Owner::add($unit, $name);
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect('/owners/create')->withInput();
        }
        return redirect('/owners');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return view('editowner', ['owner' => $owner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        return view('editowner', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, owner $owner)
    {
        $owner->name = $request->get('name', $owner->name);
        $owner->save();
        return redirect('/owners');
    }

}
