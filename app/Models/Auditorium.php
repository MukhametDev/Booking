<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $capacity
 * @property int $floor
 * @property string|null $phone
 *
 */
class Auditorium extends Model
{
    use HasFactory;

    protected $table = 'auditoriums';

    protected $fillable = ['name', 'description', 'capacity', 'floor', 'phone'];
}
