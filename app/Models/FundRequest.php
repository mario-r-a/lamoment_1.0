<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    /** @use HasFactory<\Database\Factories\FundRequestFactory> */
    use HasFactory;

    protected $primaryKey = 'fund_request_id';

    protected $fillable = [
        'requestor_id',
        'approver_id',
        'title',
        'request_date',
        'total_estimated',
        'description',
        'status'
    ];

    // Relation ke User (Requestor) (many-to-one)
    public function requestor()
    {
        return $this->belongsTo(User::class, 'requestor_id');
    }

    // Relation ke User (Approver) (many-to-one)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}