<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Question, App\Vote, App\Answer, App\User;
use Auth;

class QuestionController extends Controller
{
    /**
     * Function to process inserting new question.
     */
    public function getAllQuestions(Request $request)
    {
        // get all questions
        $data = Question::withCount('answer')->get();

        return response()->json(['data' => $data, 'status' => 'success'],200);
    }

	/**
	 * Function to process inserting new question.
	 */
    public function insert_question(Request $request)
    {
    	// Validate request data.
    	$validator = Validator::make($request->all(), [
            'question' => 'required',
        ]);

    	// Return errors if fails
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Add new question data to table.
        Question::create([
            'user_id' => Auth::user()->id,
            'question' => $request->get('question')
        ]);
        
        return response()->json(['data' => 'Question added successfully...', 'status' => 'success'],201);
    }

    /**
     * Get question details.
     */
    public function get_question_details($id)
    {
        // Get question details.
    	$data = Question::withCount('answer')->find($id);
        
        // Get all answers with comments
        $answer_data = Answer::with('user', 'comment')->where('question_id', $id)->get();

        // Add user details of each commenter
        foreach($answer_data as $ans)
        {   
            foreach($ans['comment'] as $com)
            {
                $user = User::find($com['user_id']);
                $com['user'] = $user;
            }
        }

        // Count up and down votes for question
    	$up_votes = Vote::where('votetable_type','App\Question')->where('vote','Up')->count();
    	$down_votes = Vote::where('votetable_type','App\Question')->where('vote','Down')->count();
    	
        $data['answer'] = $answer_data;
    	$data['up_votes'] = $up_votes;
    	$data['down_votes'] = $down_votes;
        $status = 'success';
        return response()->json(compact('data','status'),200);
    }
}
