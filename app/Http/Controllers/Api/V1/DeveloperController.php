<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\V1\DeveloperCollection;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    protected $developer;

    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DeveloperCollection($this->developer->paginate(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DeveloperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeveloperRequest $request)
    {
        
        $developer = $this->developer->create($request->all());

        return response()->json($developer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(Developer $developer)
    {
        return response()->json($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(DeveloperRequest $request, Developer $developer)
    {
        $developer->update($request->all());

        return response()->json($developer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return response()->json(null, 204);
    }
}
