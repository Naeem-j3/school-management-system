<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundAccount extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the user that owns the FundAccount
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receipt(): BelongsTo
    {
        return $this->belongsTo(ReceiptStudent::class, 'receipt_id');
    }
}
