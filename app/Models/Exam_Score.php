<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Exam_Score extends Model
{
    use HasFactory;
    protected $table = "exam_score";

    //id（プライマリキー）
    protected $primaryKey = 'id';

    //可変項目
    protected $fillable = 
    [
        'user_id',
        'test_title',
        'score',
        'created_at',
        'flag',
    ];
}
