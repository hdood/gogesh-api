<?php

namespace App\Jobs;

use App\Actions\Offer\IncreaseOfferViewsAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddOfferView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $offerId;
    protected $gustId;

    public function __construct($offerId,$gustId)
    {
        $this->offerId = $offerId;
        $this->gustId =  $gustId;
    }

    /**
     * Execute the job.
     */
    public function handle(IncreaseOfferViewsAction $action): void
    {
        $action->execute($this->offerId,$this->gustId);
    }
}
