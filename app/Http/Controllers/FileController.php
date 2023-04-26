<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __invoke(Request $request)
    {
        $url = $request->file('avatar')->store('avatars');

        return redirect()->back()->with([
            'fileName' => $url,
            'message' => [
                'success' => 'Arquivo enviado com sucesso!'
            ]
        ]);
    }
}
