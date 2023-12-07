<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required|string|max:255',
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
            
            return redirect()->route('user.create')->with('status', 'Usuario creado exitosamente!');
        
        } catch (\Exception $exception) {
            Log::error("Error al crear usuario: {$exception->getMessage()}");
            return redirect()->back()->withInput()->withErrors(['error' => 'Hubo un error al crear el usuario. Por favor intenta nuevamente.']);
        }
    }
    
    //edicion //


        public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            // Lógica para procesar y actualizar los datos del formulario

            foreach ($request->users as $id => $userData) {
                $user = User::findOrFail($id);
                $user->update($userData);
            }

            return redirect()->route('user.edit')->with('status', 'Usuarios actualizados exitosamente!');
        }

        $users = User::all();
        return view('user.edit', compact('users'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('user.edit')->with('status', 'Usuario borrado exitosamente!');
        } catch (\Exception $exception) {
            // Log the error
            Log::error("Error al borrar usuario: {$exception->getMessage()}");

            // Redirect back with an error message
            return redirect()->route('user.edit')->withErrors(['error' => 'Hubo un error al borrar el usuario. Por favor intenta nuevamente.']);
        }
}


}
