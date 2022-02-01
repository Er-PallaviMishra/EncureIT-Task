<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;


       /**
         * Get all of the comments for the Member
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        protected $fillable=['name','parent_id'];
        public function parentList($id=null){
            $list=self::all()->pluck('name','id');
                if(empty($id)){
                    return $list;
                }
            return isset($list[$id])?$list[$id]:null;
        }
        public static function boot()
        {
            parent::boot();

            self::creating(function($model){
                
            });

            self::created(function($model){
                $model->createdate = Carbon::now();
            });

            self::updating(function($model){
                // ... code here
            });

            self::updated(function($model){
                // ... code here
            });

            self::deleting(function($model){
                // ... code here
            });

            self::deleted(function($model){
                // ... code here
            });
        }
        public function children()
        {
            return $this->hasMany(self::class, 'parent_id', 'id');
        }

}
