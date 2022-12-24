<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index()
    {
        return view('welcome')->with([
            'products' => Product::all()
        ]);
    }

    public function dataBanner()
    {
        $data = Banner::all();
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Data Banner berhasil diambil'
        ];

        return response()->json($response, 200);
    }

    public function dataProduct()
    {
        $data = Product::all();
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Data Product berhasil diambil'
        ];

        return response()->json($response, 200);
    }

    public function registerUser(Request $request)
    {

//        upload file ke public images
        $path = Storage::putFile(
            'public/images',
            $request->file('selfie')
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'selfie' => $path,
            'level' => 'user',
            'approved' => 'N'
        ];

        $user = User::create($data);

        return redirect('/loginuser')->with('success', 'Register berhasil, silahkan login');
    }

    public function loginUser()
    {
        return view('Auth.loginuser');
    }

    public function loginUserPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if($user){
            if(Hash::check($password, $user->password)){
                if($user->level == 'user'){
                    if($user->approved == 'Y'){
                        session(['berhasil_login' => true]);
                        session(['id' => $user->id]);
                        session(['name' => $user->name]);
                        session(['email' => $user->email]);
                        session(['level' => $user->level]);
                        session(['alamat' => $user->alamat]);

//                        set auth = 1
                        Auth::login($user);

                        return redirect('/')->with('success', 'Login berhasil');
                    }else{
                        return redirect('/loginuser')->with('error', 'Akun anda belum di approve');
                    }
                }else{
                    return redirect('/loginuser')->with('error', 'Akun anda bukan user');
                }
            }else{
                return redirect('/loginuser')->with('error', 'Password salah');
            }
        }else{
            return redirect('/loginuser')->with('error', 'Email tidak ditemukan');
        }
    }

    public function profile()
    {
        $iduser = Auth::user()->id;
        $user = User::where('id', $iduser)->get();

        return view('profile')->with([
            'user' => $user
        ]);
    }
}
