<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['invoice_number', 'invoice_date', 'due_date', 'product', 'Amount_collection', 'Amount_Commission', 'section_id', 'discount', 'rate_vat', 'value_vat', 'total', 'Payment_Date', 'status', 'value_status', 'note'];

    public function section()
    {
        return $this->hasOne(Section::class,'id','section_id');
    }
}
