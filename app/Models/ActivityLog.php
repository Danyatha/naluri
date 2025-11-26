<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ActivityLog extends Model
{
    protected $primaryKey = 'id_log';
    protected $fillable = ['id_admin', 'action', 'entity', 'entity_id', 'description'];


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
