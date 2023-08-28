<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Exam extends Model
{
    use HasFactory;
    protected $table = "exam";

    //id（プライマリキー）
    protected $primaryKey = 'id';

    //可変項目
    protected $fillable = 
    [
        'test_title',
        'subject',
        'question',
        'answer',
        'model_answer',
        'allocation_of_point',
    ];
}
