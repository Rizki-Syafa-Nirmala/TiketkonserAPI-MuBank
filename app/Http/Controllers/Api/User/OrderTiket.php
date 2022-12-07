<?php

namespace App\Http\Controllers\Api\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konser;
use App\Models\Transaksi;

class OrderTiket extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $konser = Konser::where('id', $request->Konser_id)->first();
        // $konser = Konser::find($request->Konser_id);

        $request->validate([
            'Konser_id' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'jumlah_tiket' => 'required',
        ]);

        if ($user->role == 'user') {
            
            $order = Transaksi::create([
                'Konser_id' => $konser->id,
                'user_id' => auth('sanctum')->user()->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $request->jumlah_tiket * $konser->harga,
                'status' => 'pending',
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil ditambahkan',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'anda bukan user',
            ],401 );
        }
    }
}
