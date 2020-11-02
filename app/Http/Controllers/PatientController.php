<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $validated = $request->validated();
        $patient = Patient::create($validated);

        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request)
    {
        $validated = $request->validated();
        $patient = Patient::findOrFail($validated['id']);
        $patient->fill($validated);
        $patient->save();

        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $patient = Patient::findOrFail($request['id']);
        $patient->delete();
    }
}