<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TroubleshootingReport extends Model
{
    use HasFactory;

    protected $fillable = ['id_machine',
                            'id_maintainer',
                            'end_date',
                            'start_date',
                            'troubleshooting_description',
                            'troubleshooting_hypotesis',
                            'troubleshooting_check',
                            'repairs_actions',
                            'piece_to_change',
                            'piece_photo',
                            'resolved'];
}
