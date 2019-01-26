<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Vote;
use Auth;

class VoteController extends Controller
{
	/**
	* Vote to answer.
	*/
    public function vote_answer(Request $request)
    {
    	$messages = [
    		'vote.in' => 'Vote value should be Up or Down'
    	];
    	// Validate request data.
    	$validator = Validator::make($request->all(), [
            'answer_id' => 'required',
            'vote' => 'required|in: Up,Down',
        ], $messages);

    	// Return errors if fails
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Add new vote data to table.
        Vote::create([
            'user_id' => Auth::user()->id,
            'vote_for' => 'Answer',
            'vote_to_qa_id' => $request->get('answer_id'),
            'vote' => $request->get('vote')
        ]);
        
        return response()->json(['data' => 'Vote added successfully...'],201);
    }

    /**
	* Vote to question.
	*/
    public function vote_question(Request $request)
    {
    	$messages = [
    		'vote.in' => 'Vote value should be Up or Down'
    	];
    	// Validate request data.
    	$validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'vote' => 'required|in: Up,Down',
        ], $messages);

    	// Return errors if fails
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Add new vote data to table.
        Vote::create([
            'user_id' => Auth::user()->id,
            'vote_for' => 'Question',
            'vote_to_qa_id' => $request->get('question_id'),
            'vote' => $request->get('vote')
        ]);
        
        return response()->json(['data' => 'Vote added successfully...'],201);
    }
}
