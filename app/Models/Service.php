<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ClientHelper;

class Service extends Model
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
        'location_id',
        'formula',
        'apply_date',
        'redken_products',
        'loreal_products',
        'kerestase_products',
        'treatments',
        'hash'
    ];

    /**
     * Relation with stylist helpers
     * 
     * 
     */
    public function stylistHelpers() {

        return $this->hasMany(ClientHelper::class, 'client_id');
    }

    /**
     * Relation with stylist helpers
     * 
     * 
     */
    public function stylistHelpersDeleted() {

        return $this->hasMany(ClientHelper::class, 'client_id')->withTrashed();
    }
}
