<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id',        
    ];
    function Parent(int $parentID = 0) {
        if($parentID != 0){
            return $this->find($parentID);
        }
        return false;
    }
}
