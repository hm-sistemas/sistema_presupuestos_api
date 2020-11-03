<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReffererToAppointmentRequest;
use App\Http\Requests\RemoveReffererFromAppointmentRequest;
use App\Models\Referrer;

class ReferrerController extends Controller
{
    public function removeReferrerFromAppointment(RemoveReffererFromAppointmentRequest $request)
    {
        $validated = $request->validated();
        Referrer::findOrFail($validated['id'])->delete();
    }

    public function AddReferrerToAppointment(AddReffererToAppointmentRequest $request)
    {
        $validated = $request->validated();
        $validated['doctor_id'] = $validated['id'];
        Referrer::create($validated);
    }
}