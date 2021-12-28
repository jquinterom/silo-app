<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storedocuments_driversRequest;
use App\Http\Requests\Updatedocuments_driversRequest;
use App\Models\documents_drivers;

class DocumentsDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
