# upload
Upload de arquivos e imagens



## Classe de Upload de Imagens criada:##

Temos uma classe de Upload de Imagens em **App\Business\ImagemUpload**

Em seu Controller coloque:

    public function __construct()
    {
        herda o _construct de PermissaoController para gerir as permissões
        parent::__construct();

        $this->destino = [
            'caminho'   => storage_path() . '/app/public/pasta-destino/',
            'resolucao' => ['p' => [150, 150], 'm' => [500, 500], 'g' => [1024, 1024], 'n'...],
        ];
    }

- **Melhorias:** Você não Precisa criar nenhuma das pastas. O laravel já cria para você. :)
- É Possível ter diversos tamanhos de imagens ou apenas um tamanho.
- O Método para salvar as imagens recebe os parametros: 

- $imagens: Pode ser um array de imagens ou apenas 
uma imagem `<input name="imagem" type="file"> ou <input name="imagem[]" type="file">`
- $destino: *caminho* e **n** *tamanhos*.
- $white: coloque os tamanhos que você queira que crie uma borda ao redor da imagem.
- $background: a cor da borda a ser gerada.

> ImagemUpload::salva($imagens, $destino, $white = [], $background = '255, 255, 255, 0');
