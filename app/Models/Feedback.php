<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{

    protected $table = 'of_feedback';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'username','phone','body'
    ];
}
