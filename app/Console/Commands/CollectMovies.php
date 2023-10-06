<?php

namespace App\Console\Commands;

use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Console\Command;


class CollectMovies extends Command
{
    protected $signature = "fetch:movies";
    protected $description = "Fetch movies from external API";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = new Client(
            ['headers' => ['Authorization' => 'Bearer aWC54DXzbQB-TBhvpZ9s'],'verify' => false,]
        );
        $pages = 3;

        for ($page = 1; $page <= $pages; $page++) {
            $response = $client->get("https://the-one-api.dev/v2/movie?page=$page"); // Replace this URL with actual API URL
            $data = json_decode($response->getBody(), true)['docs'];

            foreach ($data as $movie) {
                Movie::updateOrCreate(
                    ['name' => $movie['name']],
                    ['budgetInMillions' => $movie['budgetInMillions']]
                );
            }
        }
    }
}
