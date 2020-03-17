<?php

namespace App\Console\Commands;

use App\Product;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexes Articles';

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param \Elasticsearch\Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. Might take a while...');

        /** @var Product $article */
        foreach (Product::get() as $article) {
            $this->client->index([
                'index' => $article->getSearchIndex(),
                'type' => $article->getSearchType(),
                'id' => $article->id,
                'body' => $this->toSearchableArray($article->toSearchArray()),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }
        $this->info("\nDone!");
    }
    public function toSearchableArray($array)
    {

        $array['id'] = $array['_id'];
        unset($array['_id']);
        return $array;
    }

}
