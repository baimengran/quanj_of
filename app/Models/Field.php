<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{

    protected $table = 'of_field';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'module_id','name','module_type','title','status','class_name','class_type','display_list','display_form'
    ];


}

