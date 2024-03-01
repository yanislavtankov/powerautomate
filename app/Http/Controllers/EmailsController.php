<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Emails;
use Illuminate\Support\Facades\DB;

class EmailsController extends Controller
{
    /**
    * Получава заявки чрез API от Microsoft Power Automate и ги записва в базата данни
    *
    * @return \Illuminate\Http\Response
    */
    public function writeRequest(Request $request)
    {
        $from = $request->from;
        $subject = $request->subject;
        $content = $request->content;
        $apiKey = env('API_KEY', '');
        if($apiKey == $request->header('api_token')){
            if(isset($request->from) && isset($request->subject) && isset($request->content)) {
                if(strpos($subject, "[TICKET:") === false){
                    $userId = 1;
                    $case = $this->generateToken(10);
                    $subject = "[TICKET:". $case . "] " . $subject;
                } else {
                    $case = substr($subject, strpos($subject, "[TICKET:") + 6, 10);
                    $user = Emails::Where('case', $case)
                                    ->get()->First();
                    $userId =  (is_object($user)) ? $user->user_id : 1;
                }
                $query = DB::table('emails')->insert([
                    'case' => $case,
                    'from' => $from,
                    'subject' => $subject,
                    'message' =>  $content,
                    'status' => 0,
                    'user_id' => $userId,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
                return ($query) ? response()->json(['OK' => 'Success'], 200) : response()->json(['error' => 'Server error'], 501);
            } else {
                return response()->json(['error' => 'Bad request'], 400);
            }
        }
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    private function generateToken($l = 10) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($chars);
        $token = '';
        for ($i = 0; $i < $l; $i++) {
            $token .= $chars[rand(0, $charLength - 1)];
        }
        return $token;
    }

}
