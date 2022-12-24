<?php
namespace App\Helpers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class UploadFile
{
    public static function uploadFile($file)
    {
        $length         = 30;
        $pool           = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $filename       = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        $tujuan_upload  = 'data_file';

        $extension      = $file->getClientOriginalExtension();
        $filenameupload = "/".$tujuan_upload."/".$filename.".".$extension;

        $file->move($tujuan_upload,$filenameupload);

        return $filenameupload;
    }
}
