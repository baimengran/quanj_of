<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;
    protected $table = 'of_issue';
    public $primaryKey = "id";

    protected $casts=[
        'created_at'=>'datetime:Y-m-d',
        'updated_at'=>'datetime:Y-m-d'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'category_id','cate_id','template_id',
        'single_pic_a','single_pic_b','single_pic_c','single_pic_d','single_pic_e',
        'multi_pic_a','multi_pic_b','multi_pic_c','multi_pic_d','multi_pic_e',
        'text_a','text_b','text_c','text_d','text_e',
        'text_f','text_g','text_h','text_i','text_j',
        'text_k','text_l','text_m','text_n','text_o',
        'text_p','text_q',
        'number_a','number_b','number_c','number_d','number_e','number_f',
        'status','sort','ad_left_status','ad_right_status','home_status','recommend_status'
    ];

}

