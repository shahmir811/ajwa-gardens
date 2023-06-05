<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'phone_number', 'status'];
    
    public function insertMessage($data)
    {
        $newRecord = [
            'description' => $data['description'],
            'phone_number' => $data['phone_number'],
        ];

        return $this->create($newRecord);
    }

}
