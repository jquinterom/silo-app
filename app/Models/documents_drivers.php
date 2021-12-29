<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents_drivers extends Model
{
    use HasFactory;

    protected $table = "documents_drivers";

    protected $fillable = ["name", "code", "url"];
}
