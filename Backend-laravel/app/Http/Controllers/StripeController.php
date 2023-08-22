<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

require_once '../vendor/autoload.php';

class StripeController extends Controller
{
    
    public function index(Request $request)
    {
        
        
    }

    public function store(Request $request)
    {//funcion que se llama cuando se hace un pago
        $stripe = new \Stripe\StripeClient('sk_test_51NhNXhIkNFXyIz1guxy9yUm9rMnRKePNfarzxJ7zExbcB1c1vq4GJOv6Uc89wnyhyFc9uuiswURPCZBOkn6hpzqx00zXMX4O7T');

        header('Content-Type: application/json');

        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $request->monto*100,
                'currency' => 'mxn',
                'description' => $request->nombre.' '.$request->correo,
                'payment_method_types' => ['card'],
                'payment_method' => $request->payment_method,
                'confirm' => true,//hace que el pago se complete
                
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
            /*return response()->json([
                'clientSecret'=>$paymentIntent->client_secret,
            ]);*/
        }catch (Exception $e){
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function create(){

    }

    public function edit(string $id)
    {
        //
    }
}
