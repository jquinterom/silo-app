<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storedocuments_driversRequest;
use App\Http\Requests\Updatedocuments_driversRequest;
use App\Models\documents_drivers;

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
            $documents = documents_drivers::all();
            if($documents->count()){
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
     * @param  \App\Http\Requests\Storedocuments_driversRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedocuments_driversRequest $request)
    {
        //
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
