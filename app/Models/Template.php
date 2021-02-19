<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;

    protected $table = 'of_template';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'category_id','subhead_d','subhead_f','template_label','template_name','status','pid','level','path'
    ];

    public function field(){
        return $this->hasMany('App\Models\Field','module_id','id');
    }

}
