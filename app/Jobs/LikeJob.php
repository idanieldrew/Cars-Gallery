<?php

namespace App\Jobs;

class LikeJob extends Job
{

    protected $car;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($car, $user)
    {
        $this->car = $car;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->car->likes()->where('like', true)->increment('count');
    }
}
