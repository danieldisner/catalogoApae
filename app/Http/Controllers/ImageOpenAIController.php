<?php

namespace App\Http\Controllers;

use OpenAI;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageOpenAIController extends Controller
{
    // Método para gerar a imagem
    public function generate(Request $request)
    {
        // Validar os dados da solicitação
        $request->validate([
            'description' => 'required|string|max:1000',
            'size' => Rule::in(['sm', 'md', 'lg'])
        ]);

        // Obter a descrição da imagem e o tamanho desejado
        $description = $request->description;
        $size = $this->getSize($request->size);

        // Criar cliente OpenAI
        $client = OpenAI::client(env('OPENAI_API_KEY'));

        // Criar imagem usando a API do OpenAI
        $response = $client->images()->create([
            'model' => 'dall-e-2',
            'prompt' => $description,
            'n' => 1,
            'size' => $size,
            'quality' => 'standard'
        ]);

        // Obter a URL da imagem gerada
        $url = $response->toArray()['data'][0]['url'];

        // Salvar a imagem localmente
        $imagePath = $this->saveImage($url);

        // Retornar a view com a URL da imagem
        return view('image.show', ['imageUrl' => $imagePath]);
    }

    // Método para converter o tamanho da imagem para o formato aceito pela API
    private function getSize($size)
    {
        switch ($size) {
            case 'lg':
                return '1024x1024';
            case 'md':
                return '512x512';
            case 'sm':
                return '256x256';
            default:
                return '512x512'; // Tamanho padrão
        }
    }

    // Método para salvar a imagem localmente
    private function saveImage($imageUrl)
    {
        // Obter o conteúdo da imagem
        $imageContent = Http::get($imageUrl)->body();

        // Gerar um nome único para a imagem
        $imageName = uniqid() . '_' . now()->timestamp . '.png';

        // Salvar a imagem na pasta storage/app/public/images
        $imagePath = 'images/' . $imageName;
        Storage::put($imagePath, $imageContent);

        // Retornar o caminho da imagem salva
        return Storage::url($imagePath);
    }
}
