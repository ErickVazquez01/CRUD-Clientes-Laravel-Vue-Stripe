<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();//recoger todos los datos que se envian
        //$inputs["password"] = Hash::make(trim($request->password));//encriptar la contraseña obtenida del request
        //borrando espacios con trim
        $respuesta = User::create($inputs);//crear un nuevo cliente con los datos que se envian (se recogen)
        return response()->json([
            "data"=>$respuesta,
            "message"=>"Guardado correctamente"
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (isset($user)){//retorna falso o verdadeso si $existe contiene algo
            return response()->json([
                "data"=>$user,
                "message"=>"Encontrado correctamente"
            ],200);
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No se encontró"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = User::find($id);
        if (isset($cliente)){//retorna falso o verdadeso si $existe contiene algo
            $cliente->name = $request->name;
            $cliente->email = $request->email;
            //$cliente->password = Hash::make($request->password);
            $cliente->phone_number = $request->phone_number;
            if ($cliente->save()){//guardar los cambios
                return response()->json([
                    "data"=>$cliente,
                    "message"=>"Actualizado correctamente"
                ],200);
            }else{
                return response()->json([
                    "error"=>true,
                    "message"=>"No se pudo actualizar actualizar"
                ],500);
            }
            
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No existe"
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = User::find($id);
        if (isset($cliente)){//retorna falso o verdadeso si $existe contiene algo
            $res = User::destroy($id);
            if ($res){//guardar los cambios
                return response()->json([
                    "data"=>$cliente,
                    "message"=>"Se elimino correctamente"
                ],200);
            }else{
                return response()->json([
                    "error"=>true,
                    "message"=>"No se pudo eliminar"
                ],500);
            }
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"No existe"
            ],404);
        }
    }
}
