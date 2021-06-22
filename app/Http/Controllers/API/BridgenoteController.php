<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BridgenoteController extends Controller
{

    public function reg1(Request $r)
    {

        $token = Hash('sha256', 'Bridgenote' . Carbon::today());

        if ($r->input('token') <> $token) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $validator = Validator::make($r->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Email and Password are empty'], 401);
        }

        //cek ada email duplikat?
        $duplicate          = DB::table('tbl_users')
            ->where('email', '=', $r->input('email'))
            ->count();

        if ($duplicate > 0) {
            return response()->json(['error' => 'Email already registered'], 401);
        }

        //berhasil
        $data = DB::table('tbl_users')->insert([
            'email' => $r->input('email'),
            'password' => Hash::make($r->input('password'))
        ]);

        return response()->json(['success' => 'success'], 200);
    }
}
