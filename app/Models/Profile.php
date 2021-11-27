<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use VK\Client\Enums\VKLanguage;
use VK\Client\VKApiClient;

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
        $vk = new VKApiClient('5.131', VKLanguage::RUSSIAN);
        $userInfo = $vk->users()->get(env('VK_ACCESS_TOKEN'), [
            'user_ids'  => [$this->soc_uid],
            'fields'    => ['photo'],
        ])[0];
        $this->name = $userInfo['first_name'] . ' ' . $userInfo['last_name'];
        $this->avatar = $userInfo['photo'];
    }
}
