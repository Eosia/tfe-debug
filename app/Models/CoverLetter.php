<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proposal;

class CoverLetter extends Model
{
    use HasFactory;

    protected $fillable =  ['proposal_id', 'job_id', 'user_id', 'content'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
