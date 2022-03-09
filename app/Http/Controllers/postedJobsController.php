<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class postedJobsController extends Controller
{
    public $jobModel;
    public function __construct(Job $job)
    {
        $this->jobModel = $job;
    }

    public function index()
    {
        $jobs = $this->jobModel->with('user')->get();
        return view('aPanel.posted-jobs.jobList', compact('jobs'));
    }

    public function delete($id)
    {
        $deleteJob = $this->jobModel->find($id);
        if ($deleteJob) {
            $deleteJob->delete();
            session()->flash('done', 'ProductColor Has Been Added !');
            return redirect()->back()->with('delete was success');
        }
    }

    public function status(Request $request, $id)
    {
        // dd($request->activation);
        $statusJob = $this->jobModel->find($id);
        if ($statusJob) {
            $statusJob->jobStatus = $request->activation;
            $statusJob->save();
        }
        return redirect(route('admin.postedJobs'));
    }
}
