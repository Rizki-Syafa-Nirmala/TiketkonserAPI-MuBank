<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Transaksi;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'admin'){
            $bayar = Pembayaran::all();
            return $bayar;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda perlu akses untuk melihat daftar pembayaran pelanggan',
            ], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $order = Transaksi::find($request->transaksi_id);

        if ($user->role == 'user'){
            $bayar = Pembayaran::create([
                'transaksi_id' => $request->transaksi_id,
                'users_id' => $user->id,
                'nama' => $request->nama,
                'jenis_pembayaran' => $request-> jenis_pembayaran,

            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Pembayaran telah berhasil',
                'data' => $bayar,
            ], 200);  
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak bisa melakukan pembayaran karena anda bukan user',
                'data' => $bayar,
            ], 401);  

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
