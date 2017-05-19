<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model {

    public function videos() {
        return $this->belongsToMany(Video::class);
    }

}
