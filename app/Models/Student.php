<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'mst_students';
    protected $primaryKey = 'student_key';

    protected $fillable = ['student_name', 'subject_key', 'grade', 'remarks'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_key');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->remarks = $model->grade >= 75 ? 'PASS' : 'FAIL';
        });
    }
}
