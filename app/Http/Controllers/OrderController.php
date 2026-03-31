<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        dd('ini api order');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'   =>  'Maaf Order Gagal',
                'errors'    =>  $validator->errors()
            ], 404);
        }
    }
}
