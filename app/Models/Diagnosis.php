<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
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
        'client_id',
        'diagnosis_type',
        'apply_date',
        'spa_visits',
        'versatility',
        'nails_feeling',
        'nails_dislikes',
        'products_used',
        'nail_type',
        'final_diagnosis',
        'personal_style',
        'professional_style',
        'personal_interestings',
        'hair_goals',
        'salon_visits',
        'hairstyle_time',
        'hair_versatility',
        'how_hairstyle',
        'hair_comfort',
        'hair_likes_dislikes',
        'hair_products_used',
        'hair_abundance',
        'diameter',
        'hair_shape',
        'condition',
        'damage_type',
        'face_type',
        'skin_tone',
        'previous_chemical_services',
        'createdby'
    ];
}
