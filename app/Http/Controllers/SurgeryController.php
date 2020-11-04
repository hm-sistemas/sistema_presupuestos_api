<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurgeryRequest;
use App\Http\Requests\UpdateSurgeryRequest;
use App\Http\Resources\SurgeryResource;
use App\Models\Surgery;
use App\Models\SurgicalTeam;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->pagination ?? 25;
        $surgeries = Surgery::paginate($paginate);

        return (SurgeryResource::collection($surgeries))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Cirugias han sido cargadas.',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SurgeryRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = 0;
        $surgery = Surgery::create($validated);
        if (!empty($request->doctors)) {
            for ($i = 0; $i < count($request->doctors); ++$i) {
                $request->doctors[$i]['surgery_id'] = $surgery->id;
                SurgicalTeam::create($request->doctors[$i]);
            }
        }

        return (new SurgeryResource($surgery))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Cirugia ha sido registrada.',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Surgery $surgery
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $surgery = Surgery::findOrFail($request->id);
        $surgery->load('patient', 'doctors', 'procedure');

        return (new SurgeryResource($surgery))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Cirugia ha sido cargada.',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Surgery $surgery
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurgeryRequest $request)
    {
        $validated = $request->validated();
        $surgeries = Surgery::findOrFail($validated['id']);
        $surgeries->fill($validated);
        $surgeries->save();

        return (new Surgery($surgeries))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Cirugia ha sido actualizada.',
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Surgery $surgery
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $surgeries = Surgery::findOrFail($request['id']);
        $surgeries->delete();

        return response()->json('Cirugia ha sido eliminada.', 204);
    }
}