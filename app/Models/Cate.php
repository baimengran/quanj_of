<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cate extends Model
{
    use SoftDeletes;

    protected $table = 'of_cate';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'title','sort','status','type','num','explain','keyword'
    ];

    public function config(){
        return $this->hasMany('App\Models\Config','cate_id','id');
    }
}
