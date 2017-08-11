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
        return collect($liked)->chunk(6);
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
        $answer1   =  $data['answer1']  ?? null;
        $answer2   =  $data['answer2']  ?? null;
        $answer3   =  $data['answer3']  ?? null;
        $answer4   =  $data['answer4']  ?? null;
        $right_answer = $data['all-right-answers'] ?? null;

        $title       =  $data['title']       ?? null;
        $description =  $data['description'] ?? null;
        $category    =  $data['category']    ?? null;
        $premium     =  $data['premium']     ?? null;
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


                for ($i = 0; $i <= count($questions); $i++) {
                    if ($i == 1) {
                        continue;
                    }
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

        $title       =  $data['title']       ?? null;
        $description =  $data['description'] ?? null;
        $category    =  $data['category']    ?? null;
        $premium     =  $data['premium']     ?? null;
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
                    // save a photo

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
}