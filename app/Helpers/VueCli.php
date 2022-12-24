<?php
namespace App\Helpers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class VueCli
{
    public static function asset($path, $manifestDirectory = '')
    {
        static $manifests = [];

        if (! Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && ! Str::startsWith($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        $manifestPath = public_path($manifestDirectory.'/vue-manifest.json');
        if (! isset($manifests[$manifestPath])) {
            if (! file_exists($manifestPath)) {
                throw new \Exception('The vue cli manifest does not exist.');
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (! isset($manifest[$path])) {
            $exception = new \Exception("Unable to locate Mix file: {$path}.");

            if (! app('config')->get('app.debug')) {
                report($exception);

                return $path;
            } else {
                throw $exception;
            }
        }

        if (file_exists(public_path($manifestDirectory.'/hot'))) {
            $url = rtrim(file_get_contents(public_path($manifestDirectory.'/hot')));

            $assetFile = Str::replaceFirst('/dist', '', $manifest[$path]);

            return new HtmlString($url.$assetFile);
        }

        return new HtmlString($manifestDirectory.$manifest[$path]);
    }
}
