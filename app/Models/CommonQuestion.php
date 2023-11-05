<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
        'for',
    ];

    public function getQuestion()
    {
        return App::getLocale() == "en" ? $this->question_en : $this->question_ar;
    }

    public function getAnswer()
    {
        return App::getLocale() == "en" ? $this->answer_en : $this->answer_ar;
    }
}
