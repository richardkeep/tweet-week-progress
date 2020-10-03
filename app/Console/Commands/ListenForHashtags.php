<?php

namespace App\Console\Commands;

use App\Tweet;
use TwitterStreamingApi;
use Illuminate\Console\Command;

class ListenForHashtags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'twitter:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for hashtags being used on Twitter';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hashtags = ['#IkoKaziKe','#FPL'];
        /*
            '#FPL',
            '#Arsenal',
            '#MUFC',
            '#MCFC',
            '#EPL',
            '#LFC',
            '#Laravel',
            '#PHP',
            '#Vuejs',
            '#JavaScript',


            'PunguzaBeiYaMafuta',
        ]; */

        TwitterStreamingApi::publicStream()
        ->whenHears($hashtags, function (array $tweet) use ($hashtags) {
            dump("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");

            // collect($hashtags)->each(function($hashtag) use ($tweet){
            //     if(stripos($tweet['text'], $hashtag) !== false) {
            //         Tweet::create([
            //             'screen_name' => $tweet['user']['screen_name'],
            //             'hashtag' => $hashtag,
            //             'tweeted_at' => $tweet['created_at'],
            //             'id_int' => $tweet['id'],
            //             'id_str' => $tweet['id_str'],
            //             'text' => $tweet['text'],
            //             'profile_image_url'  => $tweet['user']['profile_image_url']
            //         ]);
            //     }
            // });

        })
        ->startListening();

    }
}
