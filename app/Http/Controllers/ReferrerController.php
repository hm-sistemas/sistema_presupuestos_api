<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReffererToAppointmentRequest;
use App\Http\Requests\RemoveReffererFromAppointmentRequest;
use App\Http\Resources\ReferrerResource;
use App\Models\Referrer;

class ReferrerController extends Controller
{
    public function removeReferrerFromAppointment(RemoveReffererFromAppointmentRequest $request)
    {
        $validated = $request->validated();
        Referrer::findOrFail($validated['id'])->delete();

        return response()->json('Doctor referido ha sido eliminado.', 204);
    }

    public function AddReferrerToAppointment(AddReffererToAppointmentRequest $request)
    {
        $validated = $request->validated();
        $validated['doctor_id'] = $validated['id'];
        $referrer = Referrer::create($validated);

        return (new ReferrerResource($referrer))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Doctor referido ha sido registrado.',
            ],
        ]);
    }
}