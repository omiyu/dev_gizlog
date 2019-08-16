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
    private $question;
    private $category;
    private $comment;

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
        $categoryId = $request->input('tag_category_id');
        $word = $request->input('search_word');
        $categories = $this->category->all();
        $questions = $this->question->getSearchingQuestions($categoryId, $word);
        return view('user.question.index', compact('questions', 'categories', 'word')); 
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
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->getQuestionByQuestionId($id);
        $comments = $question->comment ?: [];
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
        $question = $this->question->getQuestionByQuestionId($id);
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
        return redirect()->route('question.showMyPageTop');
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
        return redirect()->route('question.showMyPageTop');
    }

    public function showMyPageTop()
    {
        $questions = $this->question->getQuestionsByUserId(Auth::id());
        $user = Auth::user();
        return view('user.question.mypage', compact('questions', 'user'));
    }

    public function confirm(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $inputs['tag_category_name'] = $this->category->where('id', $inputs['tag_category_id'])->value('name');
        if (isset($inputs['question_id'])) {
            $inputs['route'] = ['question.update', $inputs['question_id']];
            $inputs['method'] = 'PUT'; 
        } else {
            $inputs['route'] = 'question.store';
            $inputs['method'] = 'POST';
        }
        return view('user.question.confirm', compact('inputs'));
    }

    public function comment(CommentRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->comment->create($inputs);
        return redirect()->route('question.show', ['id' => $inputs['question_id']]);
    } 
}
