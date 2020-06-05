<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lampu extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function status_lampu($id_user)
    {
        try {
            $dataLampu  = DB::table('lamp_status')->where([
                'userId' => $id_user
            ])->value('status');
            if ($dataLampu) {
                $data       = [
                    'status' => 'ok',
                    'lampu' => 'on'
                ];
            } else {
                $data       = [
                    'status' => 'ok',
                    'lampu' => 'off'
                ];
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($this->gagal(), 500);
        }
    }
    public function update_lampu(Request $request, $id_user)
    {
        try {
            DB::table('lamp_status')->where([
                'userId' => $id_user
            ])->update([
                'status' => $request->status
            ]);
            $data       = [
                'status' => 'sukses',
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($this->gagal(), 500);
        }
    }

    public function gagal()
    {
        $dataGagal  = [
            'status' => 'gagal',
        ];
        return $dataGagal;
    }
}
