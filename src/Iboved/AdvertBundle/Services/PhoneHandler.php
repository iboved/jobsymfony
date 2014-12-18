<?php

namespace Iboved\AdvertBundle\Services;

use Iboved\AdvertBundle\Entity\Advert;

class PhoneHandler
{
    protected $advert;

    public function editPhone(Advert $advert)
    {
        $this->advert = $advert;

        $phone = $this->advert->getUser()->getPhone();
        $phone = preg_replace("/[^0-9]/", "", $phone);
        $phone = '+38'.substr($phone, -10, 10);

        $this->advert->getUser()->setPhone($phone);
    }
}
