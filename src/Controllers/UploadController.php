<?php
namespace Bredi\Upload\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function upload()
    {
        dd('controllers');
    }

    public function renderImagem($path = null, $tamanho = 'p', $imagem = null)
    {

        $path = storage_path() . '/app/public/' . $path . '/' . $tamanho . '/' . $imagem;

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;

    }

    public function arquivoDownload($path = null, $filename = null)
    {

        $path = storage_path() . '/data/' . $path . '/' . $filename;

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;

    }
}
