<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Mission;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $isApiRequest = $request->header('Accept') === 'application/json';
        $request->validate([
            'text' => 'required',
            'mission_id' => 'required|exists:missions,id',
            'profile_id' => 'required|exists:profiles,id',
        ]);


        $text = $request->input('text');
        $mission_id = $request->input('mission_id');
        $profile_id = $request->input('profile_id');

        $comment = new Comment();
        $comment->text = $text;
        $comment->profile_id = $profile_id;
        $comment->mission_id = $mission_id;
        $comment->save();

        $mission = Mission::find($mission_id);
        $profile = Profile::find($profile_id);

        $report_url = $mission->report_url;
        $report_method = $mission->report_method;
        $report_body = $mission->report_body ?? '[]';
        $report_headers = $mission->report_headers ?? '[]';

        $replace_patterns = ['%uid%', '%soc%', '%name%'];
        $replace_values = [$profile->soc_uid, $profile->soc_type, $profile->name];

        $report_body = str_replace($replace_patterns, $replace_values, $report_body);
        $report_body = json_decode($report_body, true);
        $report_headers = json_decode($report_headers, true);

        if ($report_url !== null && $report_method !== null) {
            $request = Http::withHeaders($report_headers);

            if ($report_method === "GET") {
                $request->get($report_url, $report_body);
            } else if ($report_method === "POST") {
                $request->post($report_url, $report_body);
            }
        }


        if ($isApiRequest) {
            return response('');
        }

        return redirect()->back();
    }
}
