<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateParkingAvailability implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    /**
     * Create a new job instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if( $this->reservation->status != 'Canceled' && $this->reservation && Carbon::parse($this->reservation->end_date)->isPast()) {
            $this->reservation['status'] = 'Done';
            $this->reservation->save();
        }

    }
}
