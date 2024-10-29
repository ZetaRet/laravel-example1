<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phones';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone_type',
        'phone_ext',
        'phone_number',
        'seeding',
    ];
}

?>