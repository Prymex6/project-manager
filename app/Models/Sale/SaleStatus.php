<?php

namespace App\Models\Sale;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleStatus extends Model
{
    use HasFactory;

    protected $table = 'sale_statuses';

    protected $fillable = ['name', 'color'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
