<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            // return redirect()->route('home');
            return redirect('/app/dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {

        $rules = [
            'password'              => 'required|string'
        ];

        $messages = [
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        // dd(Auth::user()->name->hasRole());

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $request->session()->regenerate();

            return redirect('/app/dashboard');
        } else { // false

            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        // return redirect()->route('login');

        $msg = [
            'success' => true,
            'message' => 'Logout successfully!'
        ];

        return response()->json($msg);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
