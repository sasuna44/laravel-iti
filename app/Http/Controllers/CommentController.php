<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id(); 
        $comment->post_id = $request->post_id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}

?>