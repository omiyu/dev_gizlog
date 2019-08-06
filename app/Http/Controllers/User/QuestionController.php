<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\CommentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;

class QuestionController extends Controller
{
    protected $question;
    protected $category;
    protected $comment;

    public function __construct(Question $question, TagCategory $category, Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->category = $category;
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->all();
        $categories = $this->category->getAllCategories();
        if (empty($request)) {
            $questions = $this->question->get();
        } else {
            $questions = $this->question->getSearchingQuestions($request);
        }
        return view('user.question.index', compact('questions', 'categories', 'request' )); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getAllCategories();
        return view('user.question.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $id = $this->question->create($inputs)->id;
        return redirect()->route('question.confirm', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->getQuestions($id);
        $comments = $this->comment->getComments($id);
        $loginUser = Auth::user();
        return view('user.question.show', compact('question', 'loginUser', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->getQuestions($id);
        $categories = $this->category->getAllCategories();
        return view('user.question.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->question->find($id)->fill($inputs)->save();
        return redirect()->route('question.confirm', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->question->where('id', $id)->delete();
        return redirect()->route('question.myPageTop');
    }

    public function myPageTop()
    {
        $questions = $this->question->getQuestionsByUserId(Auth::id());
        $user = Auth::user();
        return view('user.question.mypage', compact('questions', 'user'));
    }

    public function confirm($id)
    {
        $question = $this->question->getQuestions($id);
        return view('user.question.confirm', compact('question'));
    }

    public function comment(CommentRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->comment->create($inputs);
        return redirect()->route('question.show', ['id' => $inputs['question_id']]);
    } 
}
