<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class VideoCallController extends Controller
{
    //
    // En VideoCallController

    public function generateToken(Request $request)
    {
        $identity = $request->input('identity');
        $roomName = $request->input('room');

        $token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_API_KEY_SID'),
            env('TWILIO_API_KEY_SECRET'),
            3600,
            $identity
        );

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName); // Especifica la sala

        $token->addGrant($videoGrant);

        return response()->json(['token' => $token->toJWT()]);
    }


    public function vid(){
        return view('video');
    }
}
