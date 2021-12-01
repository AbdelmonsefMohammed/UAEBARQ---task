<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'title'         => "required|min:3|max:191",
            'description'   => 'required',
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
        ]);
    }
}
