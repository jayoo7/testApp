<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    /**
	 * Function to process insert new comment.
	 */
    public function insert_comment(Request $request)
    {
    	// Validate request data.
    	$validator = Validator::make($request->all(), [
            'answer_id' => 'required',
            'comment' => 'required',
        ]);

    	// Return errors if fails.
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Add new comment data to table.
        Comment::create([
            'user_id' => Auth::user()->id,
            'answer_id' => $request->get('answer_id'),
            'comment' => $request->get('comment')
        ]);
        
        return response()->json(['data' => 'Comment added successfully...', 'status' => 'status'],201);
    }
}
