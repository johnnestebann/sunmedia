<?php

namespace SunMedia;

use SunMedia\UserInterface;

class User implements UserInterface
{
    public function gender(): string
    {
        return mt_rand(0, 1) === 0 ? 'male': 'female';
    }

    public function device(): string
    {
        return mt_rand(0, 1) === 0 ? 'mobile' : 'desktop';
    }

    public function age(): int
    {
        return mt_rand(0, 99);
    }

    public function inSegment(?string $segment): bool
    {
        $inSegment = false;

        if (null !== $segment && $segment !== "") {
            $aux = explode(':', $segment);

            if ($this->age() > $aux[0] && $this->age() < $aux[1]) {
                $inSegment = true;
            }
        }

        return $inSegment;
    }
}
