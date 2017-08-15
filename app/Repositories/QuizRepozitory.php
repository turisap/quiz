<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-Jul-17
 * Time: 7:10 PM
 */

namespace App\Repositories;

use App\Photo;
use App\Question;
use App\Quiz;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        return collect($liked);
    }

    /**
     * @param array $data
     * @param $quiz
     * @param $question
     * @return bool
     *
     * Saves a quiz along with photos and questions
     */
    public static function createQuiz(array $data, $quiz, $question)
    {
        $questions =  $data['question'] ?? null;
        $questions =  static::resort($questions);
        $answer1   =  $data['answer1']  ?? null;
        $answer1   =  static::resort($answer1);
        $answer2   =  $data['answer2']  ?? null;
        $answer2   =  static::resort($answer2);
        $answer3   =  $data['answer3']  ?? null;
        $answer3   =  static::resort($answer3);
        $answer4   =  $data['answer4']  ?? null;
        $answer4   =  static::resort($answer4);
        $right_answer = $data['all-right-answers'] ?? null;
        $right_answer = explode(',', $right_answer);


        $title       =  $data['title']       ?? null;
        $description =  $data['description'] ?? null;
        $category    =  $data['category']    ?? null;
        $premium     =  isset($data['premium']) ? 1 : 0;
        $file     =  $data['picture']     ?? null;


        if ($questions && $answer1 && $answer2 && $answer3 && $answer4 && $right_answer && $category
            && $title && $description && $file) {


            DB::transaction(function () use (
                $quiz,
                $category,
                $title,
                $description,
                $premium,
                $answer4,
                $answer3,
                $answer2,
                $answer1,
                $questions,
                $question,
                $right_answer,
                $file
            ) {

                // save a photo
                $photo = new Photo();
                $name = $file->hashName();
                $size = $file->getSize();
                $file->storeAs('quizzes', $name);

                // create a quiz first
                $quiz = $quiz->create([
                    'author_id'   => auth()->user()->id,
                    'category_id' => $category,
                    'title'       => $title,
                    'description' => $description,
                    'picture'     => $name,
                    'premium'     => $premium,
                    'views'       => 0
                ]);

                $photo->create([
                    'user_id'   => 0,
                    'quiz_id'   => $quiz->id,
                    'name'      => $name,
                    'size'      => $size,
                ]);


                for ($i = 0; $i < count($questions); $i++) {
                    $question->create([
                        'quiz_id'   => $quiz->id,
                        'question'  => $questions[$i],
                        'answer1'   => $answer1[$i],
                        'answer2'   => $answer2[$i],
                        'answer3'   => $answer3[$i],
                        'answer4'   => $answer4[$i],
                        'answer'    => $right_answer[$i]
                    ]);
                }
            });
            return true;
        }
        return false;
    }





    /**
     * @param array $data
     * @param $quiz
     * @param $question
     * @return bool
     *
     * Updates a quiz
     */
    public static function updateQuiz(array $data, $quiz, $question)
    {
        $questions =  $data['question'] ?? null;
        $answer1   =  $data['answer1']  ?? null;
        $answer2   =  $data['answer2']  ?? null;
        $answer3   =  $data['answer3']  ?? null;
        $answer4   =  $data['answer4']  ?? null;
        $right_answer = $data['all-right-answers'] ?? null;
        $right_answer = explode(',', $right_answer);

        if ($questions && $answer1 && $answer2 && $answer3 && $answer4 && $right_answer) {
            $questions =  static::resort($questions);
            $answer1   =  static::resort($answer1);
            $answer2   =  static::resort($answer2);
            $answer3   =  static::resort($answer3);
            $answer4   =  static::resort($answer4);
        }

        $title       =  $data['title']       ?? null;
        $description =  $data['description'] ?? null;
        $category    =  $data['category']    ?? null;
        $premium     =  $data['premium'] ? 1 : null;
        $file     =  $data['picture']     ?? null;

        $quiz_id  = $quiz->id ?? null;



        if ($questions && $answer1 && $answer2 && $answer3 && $answer4 && $right_answer && $category
            && $title && $description) {


            DB::transaction(function () use (
                $quiz,
                $category,
                $title,
                $description,
                $premium,
                $answer4,
                $answer3,
                $answer2,
                $answer1,
                $questions,
                $question,
                $right_answer,
                $file,
                $quiz_id
            ) {

                $photo = Photo::where('quiz_id', $quiz_id)->get()->first();

                if (isset($file)) {

                    $old_name = $photo->name;

                    $photo->fill([
                        'name'      => $file->hashName(),
                        'size'      => $file->getSize(),
                    ]);

                    $photo->save();
                    $file->storeAs('quizzes', $file->hashName());

                    // delete old photo
                    Storage::delete('/quizzes/' . $old_name);
                }

                // create a quiz first
                 $quiz->fill([
                    'author_id'   => auth()->user()->id,
                    'category_id' => $category,
                    'title'       => $title,
                    'description' => $description,
                    'picture'     => $photo->name,
                    'premium'     => $premium,
                    'views'       => 0
                ]);


                $quiz->save();

                $existing_questions = $quiz->questions;

                foreach ($existing_questions as $key => $value) {
                     $value->fill([
                         'question' => $questions[$key],
                         'answer1'  => $answer1[$key],
                         'answer2'  => $answer2[$key],
                         'answer3'  => $answer3[$key],
                         'answer4'  => $answer4[$key],
                         'answer'   => $right_answer[$key]
                     ]);

                     $value->save();
                 }
            });
            return true;
        }
        return false;
    }


    /**
     * @param array $array
     * @return array
     *
     * Gets rid on not consecutive keys like 0, 3, 4
     */
    public static function resort(array $array)
    {
        $result = [];
        foreach ($array as $item) {
            $result[] = $item;
        }
        return $result;
    }


    /**
     * @param Quiz $quiz
     * @return array
     *
     * Returns an array with the numbers of right answers for a given quiz
     */
    public static function getRightAnswers(Quiz $quiz)
    {
        $questions = $quiz->questions;
        $right_answers = [];
        foreach ($questions as $question) {
            array_push($right_answers, $question->answer);
        }
        return $right_answers;
    }
}