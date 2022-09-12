<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description' , 'created_by'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoices::class);
    }
    
}
