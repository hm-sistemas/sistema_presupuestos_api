<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
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
    public function store(DoctorRequest $request)
    {
        $validated = $request->validated();
        $doctor = Doctor::create($validated);

        return new DoctorResource($doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Doctor $doctor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return new DoctorResource($doctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Doctor $doctor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request)
    {
        $validated = $request->validated();
        $doctor = Doctor::findOrFail($validated['id']);
        $doctor->fill($validated);
        $doctor->save();

        return new DoctorResource($doctor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Doctor $doctor
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $doctor = Doctor::findOrFail($request['id']);
        $doctor->delete();
    }
}