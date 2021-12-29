<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storedocuments_driversRequest;
use App\Http\Requests\Updatedocuments_driversRequest;
use App\Models\documents_drivers;
use Symfony\Component\HttpFoundation\Request;

class DocumentsDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $code_response = 200; // OK
        $message = "Datos encontrados";
        $error = true; // Error response
        $data = [];

        try {
            $data = documents_drivers::all();
            if($data->count()){
                $error = false;
            } else {
                $message = "No existen documentos";
            }
        } catch (\Exception $e){
            $code_response = 500;
            $message = $e->getMessage();
        }

        return response()->json([
            'message' => $message,
            'error' => $error,
            'data' => $data,
        ], $code_response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = [];
        $error = true; // Fail
        $message = "Registrado correctamente";
        $code_error = 0; // OK
        $files_exists = [];
        try{
            if($request->hasFile("urlfiles")){

                $this->validate($request, [
                    'urlfiles' => 'required',
                    'urlfiles.*' => 'mimes:doc,pdf,docx'
                ]);

                $files = $request->file("urlfiles");
                foreach ($files as $file) {
                    // Validar si el archivo ya se subió
                    $fileDb = documents_drivers::where('name', '=' , $file->getClientOriginalName())->get();
                    if($fileDb->count()){
                        // existe
                        $files_exists[] = $file->getClientOriginalName();
                    } else {
                        $nameFile = $file->getClientOriginalName();
                        $route = public_path("pdf/documents_drivers/" . $nameFile);

                        copy($file, $route);

                        // Objeto a registrar
                        $obj = new documents_drivers();
                        $obj->name = $file->getClientOriginalName();
                        $obj->url = $route;
                        $obj->save();
                    }
                    $error = false;
                }
            } else {
                $message = "Por favor agrege un archivo";
                $code_error =-3;
            }

            // Se registraron documentos ya existentes
            if(count($files_exists) > 0){
                $code_error = -2;
            }
        } catch (\Exception $e){
            $message = $e->getMessage();
            $code_error = -1;
        }

        return response()->json([
            'data' => $data,
            'error' => $error,
            'message' => $message,
            'code_error' => $code_error,
            'files_exists' => $files_exists
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\documents_drivers  $documents_drivers
     * @return \Illuminate\Http\Response
     */
    public function show(documents_drivers $documents_drivers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedocuments_driversRequest  $request
     * @param  \App\Models\documents_drivers  $documents_drivers
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedocuments_driversRequest $request, documents_drivers $documents_drivers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\documents_drivers  $documents_drivers
     * @return \Illuminate\Http\Response
     */
    public function destroy(documents_drivers $documents_drivers)
    {
        //
    }
}
