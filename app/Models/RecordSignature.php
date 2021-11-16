<?php 

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Auth;

trait RecordSignature 
{
    /** Listen when writing on date base */
    protected static function bootRecordSignature() {
        static::creating(function($model) {
            $model->modby     = 0;
            $model->createdby = 0;
            if (Auth::check()) {
                $model->modby     = Auth::id();
                $model->createdby = Auth::id();
            }

            if(Schema::hasColumn($model->getTable(), 'hash')) {
                self::assignHash($model);
            }
        });

        static::updating(function($model) {
            $model->modby = 0;
            if (Auth::check()) {
                $model->modby = Auth::id();
            }
        });

        static::deleting(function($model) {
            $model->modby = Auth::id();
        });

        static::restoring(function($model) {
            $model->modby = Auth::id();
        });
    }

    /** Get User that last updated */
    public function updatedByUser() {

        return $this->belongsTo('App\Models\User', 'modby', 'id');
    }

    /**
     * Get the user that created
     */
    public function createdByUser() {

        return $this->belongsTo('App\Models\User', 'modby', 'id');
    }

    /**
     * Assign has on create user object
     * 
     * @param Eloquent $model
     */
    public static function assignHash($model) {

        $model->hash = Str::random(24);
    }
}