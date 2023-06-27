<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    protected $table = 'provider';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'provider_id',
        'url',
        'name',
        'type',
    ];

    /** @var string[]  */
    protected $hidden = ['created_at', 'updated_at'];

    public function launch()
    {
        return $this->belongsTo(Launch::class);
    }
}
