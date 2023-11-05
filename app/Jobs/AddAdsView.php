<?php

namespace App\Jobs;

use App\Actions\Ads\IncreaseAdsViewsAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddAdsView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $adsId;
    protected $gustId;

    public function __construct($adsId, $gustId)
    {
        $this->adsId = $adsId;
        $this->gustId =  $gustId;
    }

    /**
     * Execute the job.
     */
    public function handle(IncreaseAdsViewsAction $action): void
    {
        $action->execute($this->adsId, $this->gustId);
    }
}
