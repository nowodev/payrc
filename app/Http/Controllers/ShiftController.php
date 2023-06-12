<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Shift;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($job_id)
    {
        // $job_id = Request::get('job_id');
        // $job = null;

        // if (!empty($job_id)) {
        //     $job = Job::findOrFail($job_id);
        // }

        return inertia('Shift', [
            'job'    => Job::find($job_id),
            'shifts' => Shift::where('job_id', $job_id)->get(),
            // 'job'  => fn () => $job
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShiftRequest $request, Job $job)
    {
        $data = $request->validated();

        $job->shifts()->create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
