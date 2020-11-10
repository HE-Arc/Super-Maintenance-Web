<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintain extends Model
{
    use HasFactory;
    protected $fillable = ['id_machine',
                            'id_maintainer',
                            'end_date',
                            'start_date'];
}
