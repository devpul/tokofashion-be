<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private function validateProduct(Request $request, $action)
    {
        $rules_store = [
            'nama'      =>  'required|string',
            'harga'     =>  'required|integer|min:1',
            'gambar'    =>  'nullable|image|max:5120',
            'deskripsi' =>  'nullable|string',
        ];

        $message_store = [
            'nama.required'     =>  'Kolom nama tidak boleh kosong!',
            'nama.string'       =>  'Nama tidak boleh integer!',
            'harga.required'    =>  'Kolom harga tidak boleh kosong!',
            'gambar.image'      =>  'Kolom gambar harus berupa image',
            'gambar.max'        =>  'Gambar tidak boleh lebih dari 5MB!',
            'deskripsi.string'  =>  'Kolom deskripsi harus string',
        ];

        if (isset($action) && $action == 'store') {
            $validator = Validator::make($request->all(), $rules_store, $message_store);
            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  'error',
                    'errors'    =>  $validator->errors()
                ], 422);
            }
            return $validator->validated();
        }

        return response()->json([
            'message'   =>  'Terjadi kesalahan pada server, silahkan coba lagi nanti.'
        ], 500);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request, 'store');
        if (! is_array($validated)) return $validated;

        $product = Product::create([
            'nama'      =>  $validated['nama'],
            'harga'     =>  $validated['harga'],
            'gambar'    =>  $validated['gambar'] ?? null,
            'deskripsi' =>  $validated['deskripsi'] ?? null,
        ]);

        return response()->json([
            'status'    =>  'success',
            'data'      =>  $product,
        ], 201);
    }

    public function update(Request $request)
    {   
        $validated = $this->validateProduct($request, 'store');
        if (! is_array($validated)) return $validated;
    }

    public function delete()
    {
        
    }
}
