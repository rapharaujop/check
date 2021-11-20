<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contract extends Model
{
    use Notifiable;
    protected $table = 'contracts';
    protected $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'closure_at', 'contract_value',
    ];

    public function users(){        
        return $this->belongsToMany(User::class, 'user_contracts', 'contract', 'salesman');
    }
}
