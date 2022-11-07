<?php

namespace App\Http\Controllers\exam;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Symfony\Component\DomCrawler\Crawler;

class ExamController extends Controller
{
    public function testSession(Request $request)
    {

        if ($request->question_count == "start") {
            $request->session()->put('question_count', 0);
            $request->session()->put('all_questions', null);
            $request->session()->put('results', 0);

        }
        $results = session::get('results');
        $question_count = session::get('question_count');

        if ($question_count > 0) {
            $wrong = 1;

            $correct_answers = array_filter($request->correct_answer, function ($value_1) {
                return ($value_1 !== null && $value_1 !== false && $value_1 !== '');
            });

            $selected_options = $request->selected_options;

            if (count($correct_answers) == count($selected_options)) {
                foreach ($correct_answers as $key => $correct_answer) {
                    if ($correct_answer != $selected_options[$key]) {
                        $wrong = 0;
                        break;
                    }
                }
            } else {
                $wrong = 0;
            }
            if ($wrong == 1) {
                $results++;
            }
        }

        if ($question_count < 5) {
            $page = Http::get('https://practice-questions.wizako.com/gre/');

            $crawler = new Crawler($page);
            $data['links'] = $crawler->filter('body > div > section > div > div > h4 > a')->each(function ($node) {
                return $node->attr('href');
            });
            $links_1 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 10, 12, 13];
            $value_2 = array_rand($links_1);
            $value_2 = $links_1[$value_2];
            //

            $type_page = Http::get('https://practice-questions.wizako.com/gre/' . $data['links'][$value_2]);

            //exclude

            $crawler_1 = new Crawler($type_page);
            $data['questions_blocks'] = $crawler_1->filter('.ques > li');
            $values = $data['questions_blocks'];
            function question_filter($key, $value, $value_2)
            {
                $exclude_questions[0] = [];
                $exclude_questions[1] = [0, 3, 4, 6, 9];
                $exclude_questions[2] = [2, 3];
                $exclude_questions[3] = [];
                $exclude_questions[4] = [3, 4];
                $exclude_questions[5] = [3, 4];
                $exclude_questions[6] = [3];
                $exclude_questions[7] = [];
                $exclude_questions[8] = [1, 3];
                $exclude_questions[9] = "remove";
                $exclude_questions[10] = [];
                $exclude_questions[11] = "remove";
                $exclude_questions[12] = [];
                $exclude_questions[13] = [2, 3, 4, 5, 7, 8, 9, 12, 14];
                $exclude_questions[14] = "remove";
                $exclude_questions[15] = "remove";

                if (array_search($key, $exclude_questions[$value_2]) !== false) {
                    return null;
                } else {
                    return $value;
                }
            }

            foreach ($values as $key => $value) {
                $question_block[$key] = question_filter($key, $value, $value_2);

            }

            $question_block = array_filter($question_block, function ($value_4) {
                return ($value_4 !== null && $value_4 !== '' && $value_4 !== false);
            });

            $all_questions = session::get('all_questions');
            if ($all_questions != null) {
                if (isset($all_questions[$value_2])) {
                    $question_block = array_diff_key($question_block, $all_questions[$value_2]);
                }

            }
            // if ($question_block == null) {
            //     return redirect()->route('session.exam');
            // }
            $random_key = array_rand($question_block);

            $crawler_2 = new Crawler($question_block[$random_key]);
            $data['question'] = $crawler_2->filter('li > p')->each(function ($node) {
                return $node->text();
            });

            $exam['question'] = $data['question'][0];
            $data['options'] = $crawler_2->filter('li > div > div > ol > li')->each(function ($node) {
                return $node->text();
            });
            $exam['options'] = $data['options'];
            $data['no_of_options'] = count($data['options']);
            $exam['correct_answers'] = $crawler_2->filter('.tooltiptext > b')->text();

            $exam['correct_answers'] = preg_split("/[-\s:]|,|Choice/", $exam['correct_answers'], -1, PREG_SPLIT_NO_EMPTY);

            $exam['correct_answers'] = array_filter($exam['correct_answers'], function ($value) {
                return ($value !== "Choice" && $value !== "Choices" && $value !== "and" && $value !== "&" && $value !== "s");

            });
            $exam['correct_answers'] = array_values($exam['correct_answers']);

            $all_questions = session::get('all_questions');
            if (!isset($all_questions[$value_2])) {
                $all_questions[$value_2][0] = $random_key;

            }
            array_push($all_questions[$value_2], $random_key);
            $question_count++;
            $request->session()->put('all_questions', $all_questions);
            $request->session()->put('question_count', $question_count);
            $request->session()->put('results', $results);

            return view('exam.question_display', compact('exam'));
        }

        $results = session::get('results');
        $question_count = session::get('question_count');

        if ($question_count > 0) {
            $wrong = 1;

            $correct_answers = array_filter($request->correct_answer, function ($value_1) {
                return ($value_1 !== null && $value_1 !== false && $value_1 !== '');
            });

            $selected_options = $request->selected_options;

            if (count($correct_answers) == count($selected_options)) {

                foreach ($correct_answers as $key => $correct_answer) {

                    if ($correct_answer != $selected_options[$key]) {
                        $wrong = 0;
                        break;
                    }
                }
            } else {
                $wrong = 0;
            }
            if ($wrong == 1) {
                $results++;
            }
        }

        session()->forget('all_questions');
        session()->forget('question_count');
        $request->session()->put('results', $results);
        $result_1 = new Result();
        $result_1->user_name = Auth::user()->name;
        $result_1->result = $results;
        $result_1->save();

        return view('exam.finish');

    }
    public function finishSession()
    {
        session()->forget('all_questions');
        session()->forget('question_count');
        $results = session::get('results');

        $result_1 = new Result();
        $result_1->user_name = Auth::user()->name;
        $result_1->result = $results;
        $result_1->save();

        return view('exam.finish');

    }
    public function Redirect()
    {
        if (Auth::user() == null) {
            return redirect()->route('register');

        }
        if (Auth::user() != null) {
            return redirect()->route('dashboard');
        }

    }
}