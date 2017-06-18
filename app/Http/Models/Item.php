<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
class Item extends Model
{
    const DE_ACTIVE = 0;
    const ACTIVE    = 1;
    protected $table = "items";
}