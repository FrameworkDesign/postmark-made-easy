<?php

namespace Weareframework\PostmarkMadeEasy\Commands;

use Illuminate\Console\Command;
use Weareframework\PostmarkMadeEasy\Library\Console\Composer;
//use Illuminate\Support\Composer;

class ComposerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postmark-made-easy:install-packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate framework autoload files';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param Composer $composer
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->composer->run(['require', 'guzzlehttp/guzzle']);
        $this->composer->run(['require', 'symfony/postmark-mailer']);
        $this->composer->run(['require', 'symfony/http-client']);
    }
}
