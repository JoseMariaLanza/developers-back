<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Http\Requests\DeveloperRequest;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::latest()->get();
        foreach ($developers as $developer)
        {
            $developer->name = $developer->get_name;
            $developer->profession = $developer->get_profession;
        }

        return view('developers.index', compact('developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeveloperRequest $request)
    {
        Developer::create([
            'name' => strtolower($request->name),
            'profession' => $request->profession,
            'position' => $request->position,
            'technology' => $request->technology
        ]);

        return back();
    }

    public function edit(Developer $developer)
    {
        return view('developers.edit', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeveloperRequest $request, Developer $developer)
    {
        $developer->update($request->all());
        $developer->save();
        return back()->with('status', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return back()->with('status', 'Eliminado con éxito');
    }
}
