<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategotyResource;
use App\Http\Resources\JobResource;
use App\Http\Resources\PublisherResource;
use App\Models\ApplyForJob;
use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public $jobModel, $categotyModel;
    public function __construct(Job $job, Category $category)
    {
        $this->jobModel = $job;
        $this->categotyModel = $category;
    }

    public function getAllCategoryAndJobs()
    {
        $categories = $this->categotyModel->with('job')->get();
        return CategotyResource::collection($categories);
    }

    ////////////////    Get All Jobs

    public function index(Request $request)
    {
        $user =  User::where('access_token', $request->header('access_token'))->first('id');

        if ($user) {
            $jobs = $this->jobModel::where('userId', $user->id)->with('category')->get();
            if (count($jobs)) {

                return JobResource::collection($jobs);
            }

            return response()->json([
                "message" => "The User you requested could not be found."
            ]);
        }
        return response()->json([
            "message" => "Please LogIn User"
        ]);
    }

    ////////////////    Get One Job

    public function jobsByPublisher(Request $request)
    {
        $user =  User::where('access_token', $request->header('access_token'))->first('id');

        if ($user) {
            $jobs = $this->jobModel::where('userId', $user->id)->with('applyForJob')->get();

            return PublisherResource::collection($jobs);
        }

        return response()->json([
            'message' => 'Please LogIn User',
        ]);
    }
    public function show(Request $request, $jobId)
    {
        $user =  User::where('access_token', $request->header('access_token'))->first('id');

        if ($user) {


            $getJob = $this->jobModel->find($jobId);

            if ($getJob) {
                return new JobResource($getJob);
            }

            return response(["message" => "The resource you requested could not be found."]);
        }
    }

    public function store(Request $request)
    {
        $access_token = $request->header('access_token');
        $user = User::where('access_token', $access_token)->first('id');

        if ($user) {
            $data = $request->validate([
                'jobTitle' => 'required|unique:jobs,jobTitle|string|min:3|max:255',
                'jobContent' => 'required|string|min:10',
                'jobImage' => 'required|image|mimes:jpg,png,webp',
                'categoryId' => 'required',
            ]);

            $data['userId'] = $user->id;
            // dd($data['jobImage']->extension());
            $fileName = time() . "." . $data['jobImage']->extension();


             $request->jobImage->move(public_path('images'), $fileName);
             $path = ("public/images/".$fileName);
            // dd($path);
            $data['jobImage'] = $fileName;

            $this->jobModel->create($data);

            return response()->json([
                "message" => "success",
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $upadteJob = $this->jobModel->find($id);

        if ($upadteJob) {

            $data = $request->validate([
                'jobTitle' => 'required|string|min:3|max:255',
                'jobContent' => 'required|string|min:10',
                'jobImage' => 'nullable|image|mimes:jpg,png,webp',
                'categoryId' => 'required',
                'userId' => 'required',
            ]);

            if ($request['jobImage']) {
                File::delete(public_path('images'), $upadteJob->jobImage);

                $fileName = time() . $data['jobImage']->extension();

                $data['jobImage'] = $fileName;

                $request->jobImage->move(public_path('images'), $fileName);
            }

            $upadteJob->update($data);

            return response()->json([
                "message" => "success",
            ]);
        }

        return response()->json([
            "message" => "The resource you requested could not be found.",
        ]);
    }

    public function delete($id)
    {
        $deleteJob = $this->jobModel->find($id);

        if ($deleteJob) {

            File::delete(public_path('images'), $deleteJob->jobImage);

            $deleteJob->delete();

            return response()->json([

                "message" => "success"
            ]);
        }

        return response()->json([
            "message" => "The resource you requested could not be found.",

        ]);
    }

    public function search(Request $request)
    {
        $jobs = $this->jobModel->where("jobTitle", 'LIKE', '%' . $request->search . '%')->get();

        return JobResource::collection($jobs);
    }
}
