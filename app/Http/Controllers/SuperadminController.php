<?php

namespace App\Http\Controllers;

use App\Exports\AprendizExport;
use App\Models\superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;


class SuperadminController extends Controller
{

    public function index()
    {
        return view('superadmin.home');
    }

    public function SuperAdminAdministrator(Request $request)
    {
        $userData = Http::get(env('URL_API') .  'user_by_roles');
       $userDataArray = $userData->json();
    
        if ($request->has('search') && !empty($request->search)) {
             $search = $request->search;
    
            $filteredData = array_filter($userDataArray, function ($user) use ($search) {
                return stripos($user['name'], $search) !== false || 
                       stripos($user['last_name'], $search) !== false || 
                       stripos($user['identification'], $search) !== false;
            });
    
            $userDataArray = array_values($filteredData);
        }
    
        if ($request->ajax()) {
            return view('partials.admin_results', ['data' => $userDataArray]);
        }

        return view('superadmin.SuperAdmin-Administrator', ['users' => $userDataArray]);
    }


   

    // public function SuperAdminNotificaciones()
    // {
    //     return view('superadmin.SuperAdmin-Notificaciones');
    // }

    public function SuperAdminConfiguracion()
    {
        return view('superadmin.SuperAdmin-Configuracion');
    }

    public function SuperAdminPermisos()
    {
        return view('superadmin.SuperAdmin-Permisos');
    }

    public function SuperAdminGraficas()
    {
        return view('superadmin.SuperAdmin-Graficas');
    }

    public function SuperAdminemail()
    {
        return view('superadmin.email');
    }

    public function SuperAdminAdministratorPerfil($id)
    {
        $response = Http::get(env('URL_API') . "user_registers/{$id}");
    
        if ($response->failed()) {
            abort(404, 'Usuario no encontrado en la API.');
        }
    
        $user = $response->json();
    
        return view('superadmin.SuperAdmin-AdministratorPerfil', compact('user'));
    }

    public function SuperAdminInstructor(Request $request)
    {
        $userData = Http::get(env('URL_API') . 'user_by_roles_instructor');
        $userDataArray = $userData->json(); 
    
        if ($request->has('search') && !empty($request->search)) {
             $search = $request->search;
    
            $filteredData = array_filter($userDataArray, function ($user) use ($search) {
                return stripos($user['name'], $search) !== false || 
                       stripos($user['last_name'], $search) !== false || 
                       stripos($user['identification'], $search) !== false;
            });
    
            $userDataArray = array_values($filteredData);
        }
    
        if ($request->ajax()) {
           return view('partials.admin_results', ['data' => $userDataArray]);
        }
            return view('superadmin.SuperAdmin-Instructor', ['users' => $userDataArray]);
    }
    

    // public function SuperAdminAprendiz(Request $request)
    // {
    //     $userData = Http::get(env('URL_API') . 'user_by_roles_aprendiz');
    //     $userDataArray = $userData->json();
    
    //     if ($request->has('search') && !empty($request->search)) {
    //         $search = $request->search;
    
    //         $filteredData = array_filter($userDataArray, function ($user) use ($search) {
    //             return stripos($user['name'], $search) !== false || 
    //                    stripos($user['last_name'], $search) !== false || 
    //                    stripos($user['identification'], $search) !== false;
    //         });
    
    //         $userDataArray = array_values($filteredData);
    //     }
    
    //     if ($request->ajax()) {
    //         return view('partials.aprendiz_results', ['aprendiz' => $userDataArray]);
    //     }
    
    //     return view('superadmin.SuperAdmin-Aprendiz', ['aprendiz' => $userDataArray]);
    // }

    public function SuperAdminAprendiz(Request $request)
{
    $userData = Http::get(env('URL_API') . 'user_by_roles_aprendiz');
    $userDataArray = $userData->json();

    // Filtrar los datos si es necesario
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;

        $filteredData = array_filter($userDataArray, function ($user) use ($search) {
            return stripos($user['name'], $search) !== false || 
                   stripos($user['last_name'], $search) !== false || 
                   stripos($user['identification'], $search) !== false;
        });

        $userDataArray = array_values($filteredData);
    }

    // Generar y descargar el archivo Excel si la solicitud es de tipo 'download'
    if ($request->has('download')) {
        return Excel::download(new AprendizExport($userDataArray), 'aprendices.xlsx');
    }

    // Retornar la vista con los datos
    return view('superadmin.SuperAdmin-Aprendiz', ['aprendiz' => $userDataArray]);
}

    public function SuperAdminInstructorPerfil($id)
    {
        $response = Http::get(env('URL_API') . "user_registers/{$id}");
    
        if ($response->failed()) {
            abort(404, 'Usuario no encontrado en la API.');
        }
    
        $user = $response->json();
    
        return view('superadmin.SuperAdmin-InstructorPerfil', compact('user'));
    }
    
    public function SuperAdminCronograma()
    {
        return view('superadmin.SuperAdmin-Cronograma');
    }

    public function SuperAdminListaAprendiz()
    {
        return view('superadmin.SuperAdmin-ListaAprendiz');
    }

    public function SuperAdminPerfil()
    {
        return view('superadmin.SuperAdmin-Perfil');
    }


    public function SuperAdminAprendizPerfil($id)
    {
        $response = Http::get(env('URL_API') . "user_registers/{$id}");
        if ($response->failed()) {
            abort(404, 'Usuario no encontrado en la API.');
        }
    
        $user = $response->json();
        return view('superadmin.SuperAdmin-AprendizPerfil',compact('user'));

    }



   


    public function SuperAdminMensajeInstructor()
    {
        return view('superadmin.SuperAdmin-MensajeInstructor');
    }

    public function SuperAdminMensajeAprendiz()
    {
        return view('superadmin.SuperAdmin-MensajeAprendiz');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(superadmin $superadmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(superadmin $superadmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, superadmin $superadmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(superadmin $superadmin)
    {
        //
    }


}
