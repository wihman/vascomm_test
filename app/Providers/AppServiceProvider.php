<?php

namespace App\Providers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('main', function ($view) {
            // example array
            // $akses = 'dashboard_read,dashboard_create,dashboard_delete,dashboard_update';

            $user           = User::find(Auth::user()->id);
            $permission___  = $user->getPermissionNames();

            $permission__   = str_replace('"',"", $permission___);
            $permission_    = str_replace('[',"", $permission__);
            $permission     = str_replace(']',"", $permission_);

            $iduser         = Auth::user()->id;
            $datauser       = User::where('users_eass.id', $iduser)
                                ->leftJoin('guru', 'users_eass.nik', '=', 'guru.nik')
                                ->get();

            return $view->with('userdetail', Crypt::encryptString($datauser))
                        ->with('userinfo', Crypt::encryptString($permission))
                        ;
        });
    }
}
