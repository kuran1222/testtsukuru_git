<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Exam_Question extends Model
{
    use HasFactory;
    protected $table = "exam_question";

    //id（プライマリキー）
    protected $primaryKey = 'id';

    //可変項目
    protected $fillable = 
    [
        'subject',
        'question',
        'model_answer',
    ];
}
