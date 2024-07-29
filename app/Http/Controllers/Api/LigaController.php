<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liga;
use Validator;


class LigaController extends Controller
{
    public function index()
    {
        $liga = Liga::latest()->get();
        $res = [
            'success' => true,
            'message' => 'Daftar Liga Sepak Bola',
            'data' => $liga,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required|unique:ligas',
            'negara' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = new Liga;
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' => true,
                'message' => 'data liga berhasil dibuat',
                'data' => $liga,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);

        }
    }

    public function show($id)
    {
        try {
            $liga = Liga::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail Liga',
                'data' => $liga,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required',
            'negara' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = new Liga;
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' => true,
                'message' => 'data liga berhasil diubah',
                'data' => $liga,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);

        }
    }
    public function destroy($id)
    {
        try {
            $liga = Liga::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Data' . $liga->nama_liga . 'berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
}
