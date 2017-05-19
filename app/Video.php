<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    public function keywords() {
        return $this->belongsToMany(Keyword::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

}
