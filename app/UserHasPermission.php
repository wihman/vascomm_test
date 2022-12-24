<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasPermission extends Model
{
    protected $fillable = [
        'iduser',
        'permission',
        'keterangan',
    ];

    public function scopeCheckPermissionExist($id, $permission)
    {
        $data = DB::table('user_has_permissions')
            ->select('user_has_permissions.id','user_has_permissions.permission')
            ->where('user_has_permissions.id', '=', $id)
            ->get();

        return $data;
    }
}
