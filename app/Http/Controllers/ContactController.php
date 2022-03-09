<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ContactController extends Controller
{
    public $contactModle;
    public function __construct(Contact $contact)
    {
        $this->contactModle = $contact;
    }
    public function index()
    {
    }
    public function sendNote(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:5|max:255',
        ]);

        $access_token = $request->header('access_token');
        $user = User::where('access_token', $access_token)->first('id');

        if ($user) {
            $this->contactModle->create([
                'userName' => $user->fristName . " " . $user->lasrName,
                'email' => $user->email,
                'phone' => $user->phone,
                'message' => $request->message
            ]);
            return response()->json([
                'message' => 'Success Send Note'
            ]);
        }

        return response()->json([
            'message' => 'Failed Send Note'
        ]);
    }
    public function ReplyNote(Request $request)
    {
        
    }
}
