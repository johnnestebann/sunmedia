<?php

namespace SunMedia;

use SunMedia\CampaignInterface;

class Campaign implements CampaignInterface
{
    public function id(): int
    {
        return mt_rand(0, 99);
    }

    public function gender(): string
    {
        return mt_rand(0, 1) === 0 ? 'male' : 'female';
    }

    public function priority(): string
    {
        return mt_rand(0, 1) === 0 ? 'high' : 'low';
    }

    public function device(): string
    {
        return mt_rand(0, 1) === 0 ? 'mobile' : 'desktop';
    }

    public function ageSegment(): string
    {
        return '0:99';
    }
}
