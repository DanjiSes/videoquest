<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
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
        $instagram = Instagram::withCredentials(new \GuzzleHttp\Client(), env('INST_USERNAME'), env('INST_PASSWORD'), new Psr16Adapter('Files'));
        $instagram->login();
        $instagram->saveSession();

        if (is_numeric($this->soc_uid)) {
            $account = $instagram->getAccountById($this->soc_uid);
            $this->soc_username = $account->getUserName();
        } else {
            $account = $instagram->getAccount($this->soc_uid);
            $this->soc_username = $account->getUserName();
            $this->soc_uid = $account->getId();
        }

        $this->name = $account->getFullName();
        $this->avatar = $account->getProfilePicUrl();
    }

    public function loadInfoFromVk()
    {
        $vk = new VKApiClient('5.131', VKLanguage::RUSSIAN);
        $userInfo = $vk->users()->get(env('VK_ACCESS_TOKEN'), [
            'user_ids'  => [$this->soc_uid],
            'fields'    => [
                'domain',
                'photo',
            ],
        ])[0];

        $this->soc_uid = $userInfo['id'];
        $this->soc_username = $userInfo['domain'];

        $this->name = $userInfo['first_name'] . ' ' . $userInfo['last_name'];
        $this->avatar = $userInfo['photo'];
    }
}
