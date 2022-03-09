<?php

namespace App\Http\Controllers;

use App\Models\ApplyForJob;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class ApplyJobController extends Controller

{
    public $applyModel, $userModel;

    public function __construct(ApplyForJob $applyForJob, User $user)
    {
        $this->applyModel = $applyForJob;

        $this->userModel = $user;
    }

    public function jobsByUser(Request $request)
    {
        $access_token = $request->header('access_token');
        $user =  $this->userModel->where('access_token', $access_token)->first();
        if ($user) {

            $applyJob =  $this->applyModel->where('userId', $user->id)->get();

            if ($applyJob) {
                return response()->json([
                    $applyJob
                ]);
            }
            return response()->json([
                "Message" => "The User Is Not Found"
            ]);
        }

        return response()->json([
            "Message" => "Please LogIn User",
        ]);
    }

    public function detailsOfJob(Request $request,$applyId)
    {
        $access_token = $request->header('access_token');
        $user =  $this->userModel->where('access_token', $access_token)->first();

        if($user){
            $applyJob =  $this->applyModel->where('userId', $user->id)->find($applyId);
            if ($applyJob) {
                return response()->json([
                   'data' =>  $applyJob
                ]);
            }
            return response()->json([
                'message' => 'You have not applied for this job',
            ]);
        }
        return response()->json([
            "Message" => "Please LogIn User",
        ]);
    }

    public function store(Request $request, $jobId)
    {
        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $accessToken = $request->header('access_token');

        $userId = $this->userModel->where('access_token', $accessToken)->first('id');

        $this->applyModel->create([
            'message' => $request->message,
            'jobId' => $jobId,
            'userId' => $userId->id
        ]);

        return response()->json([
            'message' => 'Success',
        ]);
    }
    public function update(Request $request, $applyId)
    {
        $access_token = $request->header('access_token');
        $user = $this->userModel->where('access_token', $access_token)->first('id');

        if ($user) {
            $checkUser = $this->applyModel->where('userId', $user->id)->find($applyId);
            if ($checkUser) {
                $updateApply = $checkUser->update([
                    'message' => $request->message,
                ]);

                return response()->json([
                    "message" => "success",
                ]);
            }
            return response()->json([
                'message' => 'You have not applied for this job',
            ]);
        }

        return response()->json([
            'message' => 'The User Is Not Found',
        ]);
    }
    public function delete(Request $request, $applyId)
    {
        $access_token = $request->header('access_token');
        $user = $this->userModel->where('access_token', $access_token)->first('id');

        if ($user) {
            $checkUser = $this->applyModel->where('userId', $user->id)->find($applyId);

            if ($checkUser) {
                $updateApply = $checkUser->delete();

                return response()->json([
                    "message" => "success",
                ]);
            }
            return response()->json([
                'message' => 'You have not applied for this job',
            ]);
        }
        return response()->json([
            'message' => 'The User Is Not Found',
        ]);
    }
}
