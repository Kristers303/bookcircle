<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'book_id' => $book_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', __('messages.Comment_added_successfully'));
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403, __('messages.You_not_have_the_right_delete_comment'));
        }

        $comment->delete();

        return back()->with('success', 'Komentārs veiksmīgi dzēsts!');
    }
}
