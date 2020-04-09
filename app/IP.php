<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    public function User() {
        return $this->belongsTo(User::class);
    }

    public function wasChangedBy() {
        return $this->belongsTo(User::class, 'last_modified', 'id');
    }
}
