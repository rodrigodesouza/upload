<?php
namespace Bredi\Upload\Upload;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Upload
{
    public function get()
    {
        echo "Olá mundo!";
    }

    public static function salva($imagens, $destino, $white = [], $background = '255, 255, 255, 0')
    {
        $destinos = [];

        foreach ($destino['resolucao'] as $i => $resolucao) {

            @$destinos[$i] = ['caminho' => $destino['caminho'] . $i . '/'];

            if (count($resolucao)) {
                $destinos[$i]['w'] = $resolucao[0];
                $destinos[$i]['h'] = $resolucao[1];
            }

        }

        if (isset($imagens)) {
            $returnImages = is_array($imagens) ? [] : null;

            if (is_array($imagens)) {
                foreach ($imagens as $imagem) {

                    array_push($returnImages, Upload::enviaImagem($imagem, $destinos, $white, $background));

                }
            } else {
                $returnImages = Upload::enviaImagem($imagens, $destinos, $white, $background);

            }

            return $returnImages;

        }
        return null;
    }

    #se white true, insere fundo branco
    public static function enviaImagem($imagem, $destinos, $white, $background)
    {

        $source = $imagem->getRealPath();

        list($w, $h) = getimagesize($source);
        $nome        = str_slug(pathinfo($imagem->getClientOriginalName(), PATHINFO_FILENAME));
        $extensao    = $imagem->getClientOriginalExtension();

        $novoNome = $nome . '_' . rand(1000, 9999) . '.' . $extensao;
        if (isset($destinos)) {
            foreach ($destinos as $tamanho => $pasta) {

                try {
                    $img = Image::make($source)
                        ->resize(isset($pasta['w']) ? $pasta['w'] : $w, isset($pasta['h']) ? $pasta['h'] : $h, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                    // if ($white && ($tamanho == 'p' or $tamanho == 'm')) {

                    if (count($white) > 0 && in_array($tamanho, $white)) {
                        $img->resizeCanvas($pasta['w'], $pasta['h'], 'center', false, explode(', ', $background));
                    }

                    if (!File::exists($pasta['caminho'])) {
                        $result = File::makeDirectory($pasta['caminho'], 0777, true);
                    }

                    $img->save($pasta['caminho'] . $novoNome);

                } catch (\Exception $e) {
                    dd($e);
                    return false;
                }
            }

            return $novoNome;
        }
    }

    public static function deleta($imagem, $destino)
    {

        $destinos = [];

        foreach ($destino['resolucao'] as $i => $resolucao) {

            @$destinos[$i] = ['caminho' => $destino['caminho'] . $i . '/'];

            if (count($resolucao)) {
                $destinos[$i]['w'] = $resolucao[0];
                $destinos[$i]['h'] = $resolucao[1];
            }

        }

        if (isset($destinos)) {
            foreach ($destinos as $pasta) {
                @unlink($pasta['caminho'] . $imagem);
            }
        }
    }
}
