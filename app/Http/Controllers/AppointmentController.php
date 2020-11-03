<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
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
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();
        $appointment = Appointment::create($validated);
        if (!empty($request->referrers)) {
            for ($i = 0; $i < count($request->referrers); ++$i) {
                $request->referrers[$i]['appointment_id'] = $appointment->id;
                Referrer::create($request->referrers[$i]);
            }
        }

        return new AppointmentResource($appointment);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('patient', 'doctors', 'procedure');

        return new AppointmentResource($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Appointment $appointment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
    }
}