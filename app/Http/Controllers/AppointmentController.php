<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Referrer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->pagination ?? 25;
        $appointments = Appointment::paginate($paginate);

        return (AppointmentResource::collection($appointments))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Presupuestos han sido cargados.',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = 0;
        $appointment = Appointment::create($validated);
        if (!empty($request->referrers)) {
            for ($i = 0; $i < count($request->referrers); ++$i) {
                $request->referrers[$i]['appointment_id'] = $appointment->id;
                Referrer::create($request->referrers[$i]);
            }
        }

        return (new AppointmentResource($appointment))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Presupuesto ha sido registrado.',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
        $appointment->load('patient', 'doctors', 'procedure');

        return (new AppointmentResource($appointment))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Presupuesto ha sido cargado.',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request)
    {
        $validated = $request->validated();
        $appointment = Appointment::findOrFail($validated['id']);
        $appointment->fill($validated);
        $appointment->save();

        return (new AppointmentResource($appointment))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Presupuesto ha sido actualizado.',
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $appointment = Appointment::findOrFail($request['id']);
        $appointment->delete();

        return response()->json('Presupuesto ha sido eliminado.', 204);
    }
}