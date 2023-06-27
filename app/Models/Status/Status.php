<?php

namespace App\Models\Status;

use App\Models\Launch;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasUuids;

    protected $table = 'status';

    protected $keyType = 'string';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['status_id', 'description'];

    protected $hidden = ['created_at', 'updated_at'];


    public function launch()
    {
        return $this->belongsTo(Launch::class);
    }
}
