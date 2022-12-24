<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = User::where('level', 'user')
                ->get();
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Berhasil.'
        ];
        return response()->json($response);
    }

    public function approve(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'approved' => 'Y'
        ]);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'Berhasil.'
        ];
        return response()->json($response);
    }

    public function reject(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'approved' => 'R'
        ]);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'Berhasil.'
        ];
        return response()->json($response);
    }
}
