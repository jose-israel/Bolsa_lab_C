<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar esta clase

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario tiene el rol de 'admin'
        if (Auth::user()->rol !== 'admin') {
            // Redirigir al dashboard con un mensaje de acceso denegado
            return redirect()->route('dashboard')->with('error', 'Acceso denegado.');
        }

        $search = $request->get('search');
        $rol = $request->get('rol'); // Obtener el filtro de rol

        // Obtener todos los usuarios o realizar una búsqueda si hay un término
        $users = User::where('is_approved', 1) // Agregar esta condición

        ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
            })
        ->when($rol, function ($query, $rol) {
                return $query->where('rol', $rol); // Aplicar filtro de rol si está presente
            })
            ->paginate(10); // Paginación de 10 resultados por página
            // Contar usuarios pendientes de aprobación
        $pendingUsersCount = User::where('is_approved', false)->count();

        // Pasar la variable $pendingUsersCount a la vista
        return view('usuario.index', compact('users', 'pendingUsersCount'));


    }


    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'dni' => 'nullable|string|max:20',
            'ruc' => 'nullable|string|max:20',
            'correo' => 'nullable|email',
            'celular' => 'nullable|string|max:20',
            'rol' => 'required|in:admin,empresa,postulante,supervisor',
            'archivo_cv' => 'nullable|file|max:2048',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear un nuevo usuario
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dni = $request->dni;
        $user->ruc = $request->ruc;
        $user->correo = $request->correo;
        $user->celular = $request->celular;
        $user->rol = $request->rol;

        // Manejar la subida de la foto de perfil
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Manejar la subida del archivo CV (opcional)
        if ($request->hasFile('archivo_cv')) {
            $cvPath = $request->file('archivo_cv')->store('cvs', 'public');
            $user->archivo_cv = $cvPath;
        }

        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('usuario.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'dni' => 'nullable|string|max:20',
            'ruc' => 'nullable|string|max:20',
            'correo' => 'nullable|email',
            'celular' => 'nullable|string|max:20',
            'rol' => 'required|in:admin,empresa,postulante,supervisor',
            'archivo_cv' => 'nullable|file|max:2048',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->ruc = $request->ruc;
        $user->correo = $request->correo;
        $user->celular = $request->celular;
        $user->rol = $request->rol;

        // Manejar la subida de la foto de perfil
        if ($request->hasFile('profile_photo')) {
            // Eliminar la foto anterior si existe
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Manejar la subida del archivo CV (opcional)
        if ($request->hasFile('archivo_cv')) {
            // Eliminar el archivo CV anterior si existe
            if ($user->archivo_cv) {
                Storage::disk('public')->delete($user->archivo_cv);
            }

            $cvPath = $request->file('archivo_cv')->store('cvs', 'public');
            $user->archivo_cv = $cvPath;
        }

        $user->save();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }



    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Eliminar la foto de perfil si existe
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Eliminar el archivo CV si existe
        if ($user->archivo_cv) {
            Storage::disk('public')->delete($user->archivo_cv);
        }

        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
    public function pending()
    {
        // Obtener todos los usuarios no aprobados
        $users = User::where('is_approved', false)->paginate(10);

        return view('usuario.pending', compact('users'));
    }

    /**
     * Approve a user.
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = 1; // Marcar como aprobado
        $user->save();

        return redirect()->route('usuarios.pending')->with('success', 'Usuario aprobado exitosamente.');
    }
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('usuario.show', compact('user'));
}

}
