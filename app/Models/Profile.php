<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use VK\Client\Enums\VKLanguage;
use VK\Client\VKApiClient;

class Profile extends Model
{
    use HasFactory;

    public const VK = 'vk';
    public const INST = 'inst';

    public function loadInfo()
    {
        if ($this->soc_uid === null) {
            throw new Error('User id was not provided');
        }

        if ($this->soc_type === static::VK) {
            $this->loadInfoFromVk();
        } else if ($this->soc_type === static::INST) {
            $this->loadInfoFromInstagram();
        }
    }

    public function loadInfoFromInstagram()
    {
        $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
        $account = $instagram->getAccount($this->soc_uid);

        $this->name = $account->getFullName();
        $this->avatar = $account->getProfilePicUrl();
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
