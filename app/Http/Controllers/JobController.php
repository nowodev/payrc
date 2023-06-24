<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Facades\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_id = Request::get('job_id');

        $job = null;

        if (!empty($job_id)) {
            $job = Job::findOrFail($job_id);
        }

        return inertia('Job', [
            'jobs' => Job::get(),
            'job'  => fn () => $job
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->validated();

        Job::query()->create($data);

        return to_route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $data = $request->validated();

        $job->update($data);

        return to_route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return to_route('jobs.index');
    }
}
