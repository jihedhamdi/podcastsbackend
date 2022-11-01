<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageInformative extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'Order', 'slug','contenu'
    ];

    protected static function boot()
    {
        parent::boot();

        PageInformative::creating(function ($model) {
            $model->Order = PageInformative::max('Order') + 1;
        });
    }
    
}
