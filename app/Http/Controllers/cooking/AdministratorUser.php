<?php
namespace App\Http\Controllers\cooking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class AdministratorUser extends Controller{

 // Método para iniciar sesión
 public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirigir al menú
        return redirect('/home/cooking/menu');
    }

    return redirect()->back()->withErrors(['error' => 'Credentials incorrect']);
}

 // Método para cerrar sesión
 public static function logoutUser(Request $request)
 {
     Auth::logout();
     $request->session()->invalidate();
     $request->session()->regenerateToken();

     return view('home.home');
 }

 // Método para registrar un usuario
 public static function registerUser(Request $request)
 {
     $validatedData = $request->validate([
         'nombre' => 'required|string|max:255',
         'apellido' => 'required|string|max:255',
         'email' => 'required|email|unique:persona,email',
         'password' => 'required|min:6|confirmed',
         'edad' => 'required|integer|min:1',
     ]);

     // Crear el usuario
     $user = Persona::create([
         'nombre' => $validatedData['nombre'],
         'apellido' => $validatedData['apellido'],
         'email' => $validatedData['email'],
         'password' => Hash::make($validatedData['password']),
         'edad' => $validatedData['edad'],
     ]);

     // Iniciar sesión automáticamente después del registro
     Auth::login($user);

     return response()->json(['message' => 'Usuario registrado exitosamente', 'user' => $user], 201);
 }




}
