<?php

// Route::get('upload', ['uses' => 'Bredi\Upload\Controllers\UploadController@upload']);

################ ROTA PARA EXIBIR A IMAGEM ################
Route::get('img-render/{path?}/{tamanho?}/{imagem?}', [
    'as'   => 'imagem.render',
    'uses' => 'Bredi\Upload\Controllers\UploadController@renderImagem',
]);

Route::get('arquivo/{pasta?}/{filename?}', [
    'as'   => 'arquivo.render',
    'uses' => 'Bredi\Upload\Controllers\UploadController@arquivoDownload',
]);
