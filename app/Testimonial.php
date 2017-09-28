<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'website',
        'location',
        'title',
        'comment',
        'approved_at',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'approved_at'];

    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at');
    }

    public function approve()
    {
        $this->approved_at = Carbon::now();
        $this->save();
    }

    public function unapprove()
    {
        $this->approved_at = null;
        $this->save();
    }

}
