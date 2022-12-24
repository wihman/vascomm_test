<?php

namespace App\Http\Controllers;

use App\Models\DataPesertaGuru;
use App\User;
use App\UserHasPermission;
use Illuminate\Http\Request;
use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;
use Illuminate\Support\Facades\Hash;
use mPDF;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }

    public function userhakakses($id)
    {
        $datapermission = db::select(db::raw("select * from permissions"));
        $datauser       = db::select(db::raw("select * from user_has_permissions where iduser='$id'"));

        $data = [];
        foreach ($datauser as $itempermission) {
            $data[$itempermission->permission] = $itempermission->permission;
        }

        return response()->json($data);
    }

    public function userpdf()
    {
        $user = User::all();
        $mpdf = mPDF::loadView('userpdf', $user, [], [
            'title' => 'Coba Title',
            'margin_bottom' => 10,
          ]);

		return $mpdf->stream('document.pdf');
    }

    public function data_peserta_guru()
    {
        $data       = User::leftJoin('guru', 'users_eass.nik', '=', 'guru.nik')
                    ->select('users_eass.*',
                             'guru.nama',
                             'guru.tempat_tugas',
                        'guru.npsn',
                        'guru.kec as kecamatan',
                        'guru.bid_studi_pddkn as bidang_studi_pendidikan',
                        'guru.mata_pelajaran_diajarkan as mata_pelajaran_diajarkan',
                        'guru.jenis_ptk',
                        'guru.jenjang'
                    )
                    ->get();
        return response()->json($data);
    }

    public function change_password(Request $request)
    {
        $data = [
            'password' => Hash::make($request->password)
        ];

        $user = User::where('id', Auth::user()->id)->update($data);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'Password berhasil diubah'
        ];

        return response()->json($response, 200);
    }

    public function admin_change_password(Request $request, $iduser)
    {
        $data = [
            'password' => Hash::make($request->password)
        ];

        $user = User::where('id', $iduser)->update($data);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'Password berhasil diubah'
        ];

        return response()->json($response, 200);
    }

    public function hapus_user($iduser)
    {

        try {
            $user = User::where('id', $iduser)->delete();

            $response = [
                'success' => true,
                'data' => $user,
                'message' => 'User berhasil dihapus'
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e->getMessage(),
                'message' => 'User gagal dihapus'
            ];

            return response()->json($response, 200);
        }
    }

    public function ganti_foto_profile(Request $request)
    {
        $path = Storage::putFile(
            'public/images',
            $request->file('file')
        );

        $data = [
            'img' => $path
        ];

        $user = User::where('id', Auth::user()->id)->update($data);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'Foto Profile berhasil diubah'
        ];

        return response()->json($response, 200);
    }

    public function load_foto_profile()
    {
        $foto = User::where('id', Auth::user()->id)->value('img');

        return response()->json($foto);
    }

    public function sync_all_guru(Request $request)
    {
        $dataguru = DataPesertaGuru::whereNotIn('nik', function ($query) {
            $query->select('nik')->from('users_eass');
        })
            ->limit(50)
            ->groupBy('nik')
            ->get();

        DB::beginTransaction();
        try{
            foreach ($dataguru as $item) {
                $data = [
                    'name' => $item->nama,
//                    'email' => $item->nik.'@assesment-disdik.bone.go.id',
                    'email' => $item->nik,
                    'nik' => $item->nik,
                    'job' => $item->jenis_ptk,
                    'password' => Hash::make($item->nik)
//                    'password' => Hash::make(str_replace('-', '', ($item->nik."-".$item->tanggal_lahir)))
                ];

                User::create($data);
            }

            DB::commit();

            $response = [
                'success' => true,
                'data' => '',
                'message' => 'Data berhasil disinkronkan'
            ];

            return response()->json($response, 200);
        }catch(\Exception $e){
            DB::rollback();

            $response = [
                'success' => false,
                'data' => '',
                'message' => $e->getMessage()
            ];

            return response()->json($response, 200);
        }


    }

    public function adduser(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'admin',
            'nik' => ''
        ];

        $user = User::create($data);

        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'User berhasil'
        ];

        return response()->json($response, 200);

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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = DB::table('user_has_permissions')
            ->select('user_has_permissions.id')
            ->where('user_has_permissions.iduser', '=', $id)
            ->where('user_has_permissions.permission', '=', $request->value)
            ->count();

        $datasave = [
            'iduser' => $id,
            'permission' => $request->value
        ];

        $valuepermission = substr($request->value, -6);

        if ($valuepermission == "remove") {
            $reqvalue = str_replace('remove','',$request->value);
            $sql    = UserHasPermission::where('iduser',$id)->where('permission', $reqvalue)->delete();

            $user   = User::find($id);
            $user->revokePermissionTo($reqvalue);
        }else{
            if ($data > 0) {
            }else {
                $sql    = UserHasPermission::create($datasave);
                $user   = User::find($id);
                $user->givePermissionTo($request->value);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = \App\User::find($id);

        if(!empty($table)){
            $table->delete();
            $msg = [
                'success' => true,
                'message' => 'User delete successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'User delete failed!'
            ];

            return response()->json($msg);
        }
    }
}
