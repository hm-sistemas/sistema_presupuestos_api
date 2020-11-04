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
    public function index(Request $request)
    {
        $paginate = $request->pagination ?? 25;
        $doctors = Doctor::paginate($paginate);

        return (DoctorResource::collection($doctors))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Doctores han sido cargados.',
            ],
        ]);
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

        return (new DoctorResource($doctor))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Doctor han sido registrado.',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Doctor $doctor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $doctor = Doctor::findOrFail($request->id);

        return (new DoctorResource($doctor))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Doctor han sido cargado.',
            ],
        ]);
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

        return (new DoctorResource($doctor))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Doctor ha sido actualizado.',
            ],
        ]);
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

        return response()->json('Doctor ha sido eliminado.', 204);
    }
}