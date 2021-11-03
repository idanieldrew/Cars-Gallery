<?php

namespace App\Jobs;


class CreateReplyJob extends Job
{

      protected $car;
      protected $user;
      protected $value;
      /**
       * Create a new job instance.
       *
       * @return void
       */
      public function __construct($car, $user, $value)
      {
            $this->car = $car;
            $this->user = $user;
            $this->value = $value;
      }

      /**
       * Execute the job.
       *
       * @return void
       */
      public function handle()
      {
            $this->car->comments()->create([
                  'user_id' => $this->user,
                  'parent_id' => $this->value['reply'],
                  'body' => $this->value['content']
            ]);
      }
}
