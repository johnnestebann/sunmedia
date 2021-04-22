<?php
namespace SunMedia;

use SunMedia\ExchangeInterface;

class Exchange implements ExchangeInterface
{
    /** @var CampaignInterface[]|null */
    private array $campaigns;

    public function match(?UserInterface $user): ?CampaignInterface
    {
        $matchedCampaign = null;

        if (null !== $user && count($this->campaigns) > 0) {
            
            for ($i = 0; $i < count($this->campaigns); $i++) {
                if (User::inSegment($user, $this->campaigns[$i]->ageSegment()) &&
                    $this->campaigns[$i]->gender() === $user->gender() && 
                    $this->campaigns[$i]->device() === $user->device() &&
                    $this->campaigns[$i]->priority() === 'high') {
                    $matchedCampaign = $this->campaigns[$i];
                }
            }

            if ($matchedCampaign === null && $this->campaigns[0]->priority() === "low") {
                $matchedCampaign = $this->campaigns[0];
            }
        }

        return $matchedCampaign;
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
