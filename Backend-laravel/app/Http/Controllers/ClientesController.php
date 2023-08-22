<?php



namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * //@return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cliente::all();//retorno a todos los clientes
        return Cliente::all();
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {//POST
        $inputs = $request->input();//recoger todos los datos que se envian
        $respuesta = Cliente::create($inputs);//crear un nuevo cliente con los datos que se envian (se recogen)
        return response()->json([
            "data"=>$respuesta,
            "message"=>"El cliente se guardo correctamente"
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)//retornar un cliente en especifico
    {
        $cliente = Cliente::find($id);
        if (isset($cliente)){//retorna falso o verdadeso si $existe contiene algo
            return response()->json([
                "data"=>$cliente,
                "message"=>"El cliente se encontro correctamente"
            ]);
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"El cliente no existe"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);
        if (isset($cliente)){//retorna falso o verdadeso si $existe contiene algo
            $cliente->nombre = $request->nombre;
            $cliente->correo = $request->correo;
            $cliente->telefono = $request->telefono;
            if ($cliente->save()){//guardar los cambios
                return response()->json([
                    "data"=>$cliente,
                    "message"=>"El cliente se actualizo correctamente"
                ]);
            }else{
                return response()->json([
                    "error"=>true,
                    "message"=>"El cliente no se pudo actualizar"
                ]);
            }
            
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"El cliente no existe"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)//ELIMINA
    {
        $cliente = Cliente::find($id);
        if (isset($cliente)){//retorna falso o verdadeso si $existe contiene algo
            $res = Cliente::destroy($id);
            if ($res){//guardar los cambios
                return response()->json([
                    "data"=>$cliente,
                    "message"=>"El cliente se elimino correctamente"
                ]);
            }else{
                return response()->json([
                    "error"=>true,
                    "message"=>"El cliente no se pudo eliminar"
                ]);
            }
        }else{
            return response()->json([
                "error"=>true,
                "message"=>"El cliente no existe"
            ]);
        }
    }

    public function createStripeCustomer(Request $request){

        require_once '../vendor/autoload.php';
        require_once '../secrets.php';

        $stripe = new \Stripe\StripeClient('sk_test_51NhNXhIkNFXyIz1guxy9yUm9rMnRKePNfarzxJ7zExbcB1c1vq4GJOv6Uc89wnyhyFc9uuiswURPCZBOkn6hpzqx00zXMX4O7T');

        header('Content-Type: application/json');

        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 200,
                'currency' => 'mxn',

                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        }catch (Exception $e){
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
