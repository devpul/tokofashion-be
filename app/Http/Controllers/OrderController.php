<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::get();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $orders
        ], 200);
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

        // mengambil product dengan id tersebut.
        $product = Product::where('id', $request->product_id)->first();

        // kalau product gak ada maka keluarkan message tsb.
        if (!$product) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'Maaf Product ID yang anda inginkan tidak ada'
            ], 404);
        }

        $order = Order::create([
            'product_id'    =>  $request->product_id,
            'quantity'  =>  $request->quantity,
            'user_id'   =>  $request->user()->id
        ]);

        return response()->json([
            'message'   =>  'Order berhasil disimpan',
            'order' =>  $order
        ]);
    }

    public function konfirmasi(Request $request)
    {
        // cek role
        if ($request->user()->role !== "admin") {
            return response()->json([
                "message"   =>  "Maaf anda bukan admin."
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            "order_id"  =>  'required|integer',
            "status"    =>  'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'   =>  'Maaf Konfirmasi Gagal',
                'errors'    =>  $validator->errors(),
            ], 422);
        }

        // cek order id
        $order = Order::where('id', $request->order_id)->first();

        if (! $order) {
            return response()->json([
                'message'   =>  'Maaf Order ID tidak ditemukan.'
            ], 404);
        }

        $order->status_order = $request->status;
        $order->save();

        return response()->json([
            'message'   =>  'Order Berhasil Diupdate',
            'order' =>  $order
        ]);
    }

    public function history(Request $request)
    {
        $user_id = $request->user()->id;
        $orders = Order::where('user_id', $user_id)->with('product:id,nama,harga,gambar')->first();

        return response()->json([
            'message'   =>  'Riwayat Berhasil Ditampilkan.',
            'orders'    =>  $orders
        ]);
    }
}
