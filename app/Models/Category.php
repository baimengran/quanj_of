<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'of_category';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'id','title','pid','level','path','ad','icon','sort','status','class_type','is_nav_display','is_add_body','num','pic','text','is_list'
    ];

    public function template(){
        return $this->hasOne('App\Models\Template','category_id','id');
    }
}
