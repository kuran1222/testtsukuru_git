<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Exam;
use App\Models\Exam_Score;
use App\Models\Exam_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;



class TestTsukuruController extends Controller
{

    //ログイン
    public function login() {
        return view('auth.login');
    }

    //アカウント新規作成
    public function register() {
        return view('auth.register');
    }

    //生徒アカウント
    public function index_student() {
        if (Auth::check()) {
            $exams = DB::table('exam')
            ->select('test_title', 'subject')
            ->groupBy('test_title')
            ->groupBy('subject')
            ->get();

            return view('testtsukuru.index_student',compact('exams'));
        }else{
            return view('auth.login');
        }
    }

    public function exam(Request $request) {
        if (Auth::check()) {
            $session['test_title'] = $request->session()->get('test_title', $request->test_title);
            $session['answer'] = $request->session()->get('answer', $request->answer);

            $exams = Exam::where('test_title', '=', $request->test_title)->get();
            return view('testtsukuru.exam', compact('exams', 'session'));
        }else{
            return view('auth.login');
        }
    }

    public function exam_result(Request $request) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $session['test_title'] = $request->session()->get('test_title', $request->test_title);

            $user_answers = $request->session()->get('user_answer', $request->user_answer);

            $final_score = 0;
            foreach($user_answers as $val){
                $correct = Exam::where([
                            ['test_title', '=', $request->test_title],['model_answer', '=',  $val]])->sum('allocation_of_point');
                $final_score += $correct;
                $correct = null;
            }

            Exam_Score::create([
                'test_title' => $request->test_title,
                'user_id' => $user_id,
                'score' => $final_score,
            ]);

            $request->session()->forget('user_answer');

            return view('testtsukuru.exam_result', compact('user_answers','final_score', 'session'));
        }else{
            return view('auth.login');
        }
    }


    //教師アカウント
    public function index_teacher(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->attributes == 1) {
                
                $exams = DB::table('exam')
                        ->select('test_title', 'subject')
                        ->groupBy('test_title')
                        ->groupBy('subject')
                        ->get();
                return view('testtsukuru.index_student',compact('exams'));
            }

            $request->session()->forget('test_title');
            $request->session()->forget('subject');
            $request->session()->forget('question');
            $request->session()->forget('question1');
            $request->session()->forget('question2');
            $request->session()->forget('question3');
            $request->session()->forget('model_answer');
            $request->session()->forget('model_answer1');
            $request->session()->forget('model_answer2');
            $request->session()->forget('model_answer3');

            return view('testtsukuru.index_teacher');
        }else{
            return view('auth.login');
        }
    }

    public function test_edit(Request $request) {
        if (Auth::check()) {
            $session['id'] = $request->session()->get('id', $request->id);
            $search_question = $request->session()->get('question', $request->question);
            $search_model_answer = $request->session()->get('model_answer', $request->model_answer);
            

            $session['test_title'] = $request->session()->get('test_title', '');
            $session['subject'] = $request->session()->get('subject', '');

            $session['question1'] = $request->session()->get('question1', '');
            $session['model_answer1'] = $request->session()->get('model_answer1', '');
            $session['allocation_of_point1'] = $request->session()->get('allocation_of_point1', '');

            $session['question2'] = $request->session()->get('question2', '');
            $session['model_answer2'] = $request->session()->get('model_answer2', '');
            $session['allocation_of_point2'] = $request->session()->get('allocation_of_point2', '');

            $session['question3'] = $request->session()->get('question3', '');
            $session['model_answer3'] = $request->session()->get('model_answer3', '');
            $session['allocation_of_point3'] = $request->session()->get('allocation_of_point3', '');

            if (isset($search_question)) {
                if(empty($session['question1'])){
                    $session['question1'] = $search_question;
                    $request->session()->put('question1', $search_question);
                } else if(empty($session['question2'])){
                    $session['question2'] = $search_question;
                    $request->session()->put('question2', $search_question);
                }else if(empty($session['question3'])){
                    $session['question3'] = $search_question;
                    $request->session()->put('question3', $search_question);
                }
                $search_question = "";
            }

            if (isset($search_model_answer)) {
                if(empty($session['model_answer1'])){
                    $session['model_answer1'] = $search_model_answer;
                    $request->session()->put('model_answer1', $search_model_answer);
                } else if(empty($session['model_answer2'])){
                    $session['model_answer2'] = $search_model_answer;
                    $request->session()->put('model_answer2', $search_model_answer);
                }else if(empty($session['model_answer3'])){
                    $session['model_answer3'] = $search_model_answer;
                    $request->session()->put('model_answer3', $search_model_answer);
                }
                $search_model_answer = "";
            }

            
            return view('testtsukuru.test_edit', compact('search_question','session', 'request'));
        }else{
            return view('auth.login');
        }
    }

    public function test_search(Request $request) {
        if (Auth::check()) {
            $exam_questions = Exam_Question::query();

            $keyword = $request->input('keyword');

            if(!empty($keyword)) {
                $exam_questions->where('question', 'LIKE', "%{$keyword}%")
                                ->orWhere('model_answer', 'LIKE', "%{$keyword}%")
                                ->orWhere('subject', 'LIKE', "%{$keyword}%");
            }
            $posts = $exam_questions->get();

            return view('testtsukuru.test_search', compact('posts', 'keyword'));
        }else{
            return view('auth.login');
        }
    }
    
    public function test_confirm(Request $request) {
        if (Auth::check()) {
            $request->validate([
                'test_title'  => ['required'],
                'subject'  => ['required'],
                'question1' => ['required'],
                'model_answer1'  => ['required'],
            ], [
                'test_title.required' => 'テスト名は必須です。',
                'subject.required' => '科目を選択して下さい。',
                'question1.required' => '問題文を入力して下さい。',
                'model_answer1.required' => '模範解答を入力して下さい。'
            ]);
            
            if ($request->session()->get('errors')) {
                return view('testtsukuru.test_edit', compact('request'));
            }


            $request->session()->put('test_title', $request->test_title);
            $request->session()->put('subject', $request->subject);

            $request->session()->put('question1', $request->question1);
            $request->session()->put('model_answer1', $request->model_answer1);
            $request->session()->put('allocation_of_point1', $request->allocation_of_point1);

            $request->session()->put('question2', $request->question2);
            $request->session()->put('model_answer2', $request->model_answer2);
            $request->session()->put('allocation_of_point2', $request->allocation_of_point2);

            $request->session()->put('question3', $request->question3);
            $request->session()->put('model_answer3', $request->model_answer3);
            $request->session()->put('allocation_of_point3', $request->allocation_of_point3);

            return view('testtsukuru.test_confirm', compact('request'));

        }else{
            return view('auth.login');
        }
    }

    public function test_create(Request $request) {

        Exam::create([
            'test_title' => $request->test_title,
            'subject' => $request->subject,
            'question' => $request->question1,
            'model_answer' => $request->model_answer1,
            'allocation_of_point' => $request->allocation_of_point1,
        ]);


        if(isset($request->question2)){
            Exam::create([
                'test_title' => $request->test_title,
                'subject' => $request->subject,
                'question' => $request->question2,
                'model_answer' => $request->model_answer2,
                'allocation_of_point' => $request->allocation_of_point2,
            ]);
        }

        if(isset($request->question3)){
            Exam::create([
                'test_title' => $request->test_title,
                'subject' => $request->subject,
                'question' => $request->question3,
                'model_answer' => $request->model_answer3,
                'allocation_of_point' => $request->allocation_of_point3,
            ]);
        }

        if(isset($request->question1)){
            $exam_question1 = DB::table('exam_question')
                            ->where('question', '=', $request->question1)
                            ->select('question')
                            ->first();
            if(empty($exam_question1)){
                Exam_Question::create([
                    'subject' => $request->subject,
                    'question' => $request->question1,
                    'model_answer' => $request->model_answer1,
                ]);
            }
        }

        if(isset($request->question2)){
            $exam_question2 = DB::table('exam_question')
                            ->where('question', '=', $request->question2)
                            ->select('question')
                            ->first();
            if(empty($exam_question2)){
                Exam_Question::create([
                    'subject' => $request->subject,
                    'question' => $request->question2,
                    'model_answer' => $request->model_answer2,
                ]);
            }
        }

        if(isset($request->question3)){
            $exam_question3 = DB::table('exam_question')
                            ->where('question', '=', $request->question3)
                            ->select('question')
                            ->first();
            if(empty($exam_question3)){
                Exam_Question::create([
                    'subject' => $request->subject,
                    'question' => $request->question3,
                    'model_answer' => $request->model_answer3,
                ]);
            }
        }

        $request->session()->forget('test_title');
        $request->session()->forget('subject');
        $request->session()->forget('question1');
        $request->session()->forget('question2');
        $request->session()->forget('question3');
        $request->session()->forget('model_answer1');
        $request->session()->forget('model_answer2');
        $request->session()->forget('model_answer3');
        $request->session()->forget('allocation_of_point1');
        $request->session()->forget('allocation_of_point2');
        $request->session()->forget('allocation_of_point3');

        return view('testtsukuru.index_teacher');
    }

    public function test_result() {
        if (Auth::check()) {
            $results = DB::table('exam_score')
            ->join('users', 'exam_score.user_id', '=', 'users.id')
            ->select('test_title', 'score', 'name','exam_score.created_at')
            ->get();
            
            return view('testtsukuru.test_result', compact('results'));
        }else{
            return view('auth.login');
        }
    }

    public function student_list() {
        if (Auth::check()) {
            $students = User::where('attributes', '1')->get();
            return view('testtsukuru.student_list', compact('students'));
        }else{
            return view('auth.login');
        }
    }

    public function student_detail(Request $request) {
        if (Auth::check()) {
            $session['id'] = $request->session()->get('id', $request->id);
            $session['name'] = $request->session()->get('name', $request->name);
            $session['email'] = $request->session()->get('email', $request->email);
            $session['created_at'] = $request->session()->get('created_at', $request->created_at);

            $students = User::where('id', '=', $request->id)->get();

            $results = DB::table('exam_score')
                    ->join('users', 'exam_score.user_id', '=', 'users.id')
                    ->select('test_title', 'score','exam_score.created_at')
                    ->where('user_id', '=', $request->id)
                    ->get();

            return view('testtsukuru.student_detail', compact('students', 'results', 'session'));
        }else{
            return view('auth.login');
        }
    }
}
