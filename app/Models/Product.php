<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /**
	 * The database uses softDeletes.
	 *
	 */
    use HasFactory, RecordSignature, SoftDeletes;

    /**
	 * The fields that have dates and need Carbon instances
	 *
	 * @var array
	 */
    protected $dates = ['deleted_at'];

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
        'name',
        'brand_id',
        'url_image',
		'company_id',
		'hash'
    ];
}
