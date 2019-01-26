<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Answer, App\Vote;
use Auth;

class AnswerController extends Controller
{
    /**
	 * Function to process insert new answer.
	 */
    public function insert_answer(Request $request)
    {
    	// Validate request data.
    	$validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'answer' => 'required',
        ]);

    	// Return errors if fails.
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Add new answer data to table.
        Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $request->get('question_id'),
            'answer' => $request->get('answer')
        ]);
        
        return response()->json(['data' => 'Answer added successfully...', 'status' => 'success'],201);
    }

    /**
     * Get question details.
     */
    public function get_answer_details($id)
    {
        // Get question details.
        $data = Answer::with('comment')->withCount('comment')->find($id);

        // count up and down votes for answer
        $up_votes = Vote::where('votetable_type','App\Answer')->where('vote','Up')->count();
        $down_votes = Vote::where('votetable_type','App\Answer')->where('vote','Down')->count();
        
        $data['up_votes'] = $up_votes;
        $data['down_votes'] = $down_votes;
        $status = 'success';
        return response()->json(compact('data','status'),200);
    }
}
