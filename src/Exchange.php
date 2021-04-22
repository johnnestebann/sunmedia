<?php
namespace SunMedia;

use SunMedia\ExchangeInterface;

class Exchange implements ExchangeInterface
{
    /** @var CampaignInterface[]|null */
    private array $campaigns;

    public function match(?UserInterface $user): ?CampaignInterface
    {
        $campaign = null;

        if (null !== $user) {

        }

        return $campaign;
    }

    public function addCampaign(?CampaignInterface $campaign): void
    {
        if (null !== $campaign) {
            $this->campaigns[] = $campaign;
        }
    }

    public function removeCampaign(?CampaignInterface $campaign): void
    {
        if (null !== $campaign && count($this->campaigns) > 0) {
            $this->campaigns = array_filter($this->campaigns, function (CampaignInterface $camp) use ($campaign) {
                return $campaign->id() !== $camp->id();
            });
        }
    }

    public function campaigns(): array
    {
        return $this->campaigns;
    }

    public function getCampaignById(?int $id): ?CampaignInterface
    {
        $campaign = null;

        if (null !== $id && count($this->campaigns) > 0) {

            $found = false;
            $i = 0;

            do {

                if ($this->campaigns[$i]->id() === $id) {
                    $found = true;
                    $campaign = $this->campaigns[$id];
                }

                $i++;
            } while (!$found && $i < count($this->campaigns));
        }

        return $campaign;
    }
}
