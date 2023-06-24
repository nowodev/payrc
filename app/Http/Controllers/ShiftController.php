<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Shift;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($job_id)
    {
        $shift_id = Request::get('shift_id');
        $job      = null;
        $shift    = null;

        if (!empty($job_id)) {
            $job = Job::findOrFail($job_id);
        }

        if (!empty($shift_id)) {
            $shift = Shift::findOrFail($shift_id);
        }

        return inertia('Shift', [
            'job'    => $job,
            'shifts' => Shift::where('job_id', $job_id)->get(),
            'shift'  => fn () => $shift
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShiftRequest $request, Job $job)
    {
        $data = $request->validated();

        $job->shifts()->create($data);

        return to_route('shift.index', $job);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShiftRequest $request, Job $job, Shift $shift)
    {
        $data = $request->validated();

        $job->shifts()->find($shift->id)->update($data);

        return to_route('shift.index', $job);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job, Shift $shift)
    {
        $shift->delete();

        return to_route('shift.index', $job);
    }
}
