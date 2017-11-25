<?php

namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'address', 'cep', 'number', 'complement', 'city', 'neighborhood', 'state', 'user_id'
    ];


}
