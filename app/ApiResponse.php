<?php

namespace App;

class ApiResponse
{
    static function ok(string $mensaje, array $respuesta = null, string $clave = 'response'){
        return response([
            'success' => true,
            'message' => $mensaje,
            $clave => $respuesta
        ], 200);
    }

    static function created(string $mensaje, array $respuesta = null, string $clave = 'response'){
        return response([
            'success' => true,
            'message' => $mensaje,
            $clave => $respuesta
        ], 201);
    }

    static function notFound(string $mensaje){
        return response([
            'success' => false,
            'message' => $mensaje
        ], 404);
    }

    static function badRequest($mensaje){
        return response([
            'success' => false,
            'message' => $mensaje
        ], 400);
    }

    static function serverError(string $mensaje = 'Ocurrio un error'){
        return response([
            'success' => false,
            'message' => $mensaje
        ], 500);
    }
}