<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-Jul-17
 * Time: 7:10 PM
 */

namespace App\Repositories;

use App\Question;
use App\Quiz;

class QuizRepozitory
{
    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public static function getAllUsersQuizzes($ids)
    {
        $liked = [];
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $user = Quiz::find($id);
                $liked[] = $user;
            }
        }
        return collect($liked)->chunk(6);
    }


    public static function createQuiz(array $data, $quiz)
    {
        $questions =  $data['question'] ?? null;
        $answer1   =  $data['answer1']  ?? null;
        $answer2   =  $data['answer2']  ?? null;
        $answer3   =  $data['answer3']  ?? null;
        $answer4   =  $data['answer4']  ?? null;
        $right_answer = $data['all-right-answers'] ?? null;

        $title       =  $data['title'] ?? null;
        $description =  $data['description'] ?? null;
        $category    =  $data['category'] ?? null;
        $premium     =  $data['premium']  ?? null;


        if ($questions && $answer1 && $answer2 && $answer3 && $answer4 && $right_answer && $category
            && $title && $description) {

            // create a quiz first
            $quiz->fill([
                'author_id'   => auth()->user()->id,
                'category_id' => $category,
                'title'       => $title,
                'description' => $description,
                'picture'     => 'there should be an ID',
                'premium'     => $premium,
                'views'       => 0
            ]);

            $quiz->save();
            echo 'dkfj';

            for ($i = 0; $i < count($questions); $i++) {

            }
        }
    }
}