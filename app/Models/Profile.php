<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function loadInfo()
    {
        if ($this->soc_uid === null) {
            throw new Error('User id was not provided');
        }

        if ($this->soc_type === 'vk') {
            $this->loadInfoFromVk();
        } else if ($this->soc_type === 'ig') {
            $this->loadInfoFromIg();
        }
    }

    public function loadInfoFromIg()
    {
        // https://www.instagram.com/savchenko.dev/?__a=1
    }

    public function loadInfoFromVk()
    {
    }
}
