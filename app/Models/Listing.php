<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;


    // protected $fillable = ['company', 'title', 'website', 'description', 'tags', 'email', 'location', 'logo', 'user_id'];
    public function scopeFilter($query, array $filters) {
    // filter listings by tag click
     if($filters['tag']) {
         $query->where('tags', 'like', '%' . request('tag') . '%');
     };
      // filter listings by search
      if($filters['search']) {
          $query->where('title', 'like', '%' . request('search') . '%')
          ->orWhere('description', 'like', '%' . request('search') . '%')
          ;
      }
    }
    public function user() {
        return $this.belongsTo(User::class, 'user_id');
    }
}
