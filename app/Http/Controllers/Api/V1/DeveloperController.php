<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Developer;
//use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\V1\DeveloperCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

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
        $developer = new DeveloperCollection($this->developer->paginate(), 200);

        //return ApiResponse::ok('Lista de desarrolladores', $developer->toArray(),'desarrolladores');

        return response([
            'success' => true,
            'message' => 'Lista de desarrolladores',
            'desarrolladores' => $developer,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DeveloperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'profession' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'position' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'technology' => 'required|regex:/^[\pL\s\-]+$/u|max:255'
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'success' => false,
                    'error' => $validator->errors(),
                ],
                400
            );
        }

        DB::beginTransaction();

        try {

            $developer = Developer::create($data);

            DB::commit();
            return response([
                'success' => true,
                'message' => 'Desarrollador creado correctamente',
                'desarrollador' => $developer,
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            return (env('APP_DEBUG')) ? ApiResponse::serverError($e->getMessage()) : ApiResponse::serverError('Ups! Ocurrio un error.');
        }


        //return back();
        //return redirect()->action('v1/DeveloperController@index');



        //return response()->json($developer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::where('id', $id)->first();

        if (!$developer) {
            return response([
                'success' => false,
                'message' => 'No se encontro Desarrollador'
            ], 200);
        }

        return response([
            'success' => true,
            'message' => 'Desarrollador solicitado',
            'desarrollador' => $developer,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     *
     */

    /* public function update(DeveloperRequest $request, Developer $developer)
    {
        $developer->update($request->all());

        return response()->json($developer);
    }   */

    public function update(Request $request, $id)
    {
        //$developer = Developer::where('developers',$developer)->first();

        $developer = Developer::find($id);

        if (!$developer) {
            return response([
                'success' => false,
                'message' => 'No se encontro Desarrollador'
            ], 404);
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'profession' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'position' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'technology' => 'required|regex:/^[\pL\s\-]+$/u|max:255'
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'success' => false,
                    'error' => $validator->errors(),
                ],
                400
            );
        }
        //$developer->update($data);

        //$developer = Developer::update($data);

        // $developer = Developer::where('id',$id)->update($data);

        $developer->update($data);

        return response([
            'success' => true,
            'message' => 'Desarrollador actualizado correctamente',
            'desarrollador' => $developer,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::find($id);

        if (!$developer) {
            return response([
                'success' => false,
                'message' => 'No se encontro Desarrollador'
            ], 200);
        }

        $developer->delete();

        return response([
            'success' => true,
            'message' => 'Desarrollador eliminado',
            'desarrollador' => $developer,
        ], 201);

        //return response()->json(null, 204);
    }
}
