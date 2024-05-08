<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Criar um novo usuário
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = now(); // Define a data atual como a data de verificação do email
        $user->password = Hash::make($request->password); // Hash da senha
        $user->remember_token = base64_encode(random_bytes(10)); // Cria um remember token aleatório
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }
}