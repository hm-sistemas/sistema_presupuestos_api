<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedureRequest;
use App\Http\Requests\UpdateProcedureRequest;
use App\Http\Resources\ProcedureResource;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = Procedure::paginate();

        return ProcedureResource::collection($procedures);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProcedureRequest $request)
    {
        $validated = $request->validated();
        $procedure = Procedure::create($validated);

        return new ProcedureResource($procedure);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureRequest $request)
    {
        $validated = $request->validated();
        $procedure = Procedure::findOrFail($validated['id']);
        $procedure->name = $validated['name'];
        $procedure->save();

        return new ProcedureResource($procedure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $procedure = Procedure::findOrFail($request['id']);
        $procedure->delete();
    }
}