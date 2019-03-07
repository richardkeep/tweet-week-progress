<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetWeekProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:week-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet week progress';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->tweet();
    }

    public function tweet()
    {
         $connection = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            config('twitter.token'),
            config('twitter.secret')
         )->post('statuses/update', [
             'status' => $this->weekProgress()
        ]);
    }

    public function weekProgress()
    {
        $totalTime = Carbon::now()->endOfWeek()->timestamp - Carbon::now()->startOfWeek()->timestamp;
        $progressSofFar = Carbon::now()->timestamp - Carbon::now()->startOfWeek()->timestamp;

        return round($progressSofFar / $totalTime * 100) . "%";
    }
}
