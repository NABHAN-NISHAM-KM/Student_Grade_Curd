<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'mst_subjects';
    protected $primaryKey = 'subject_key';

    protected $fillable = ['subject_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'subject_key');
    }

}
