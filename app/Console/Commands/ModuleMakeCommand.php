<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ModuleMakeCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    /**

     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {module}
        { --app : make app dir}
        { --database : make database dir}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Your Custom Module!';

    /**
     * Create a new command instance.
     *
     *@param  \Illuminate\Filesystem\Filesystem  $files

     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return null
     */
    public function handle()
    {
        // module address
        $path = $this->laravel->basePath('Modules/' . $this->argument('module'));
        // app address
        $app = $path . '/app';

        $database = $path . '/database';

        // check created module
        if (is_dir($path)){
            $this->info("this module " .  $this->argument('module') . 'is already exist!');
        }
        // make module & options
        $this->files->makeDirectory($path);
        $this->option('app') ?
            $this->files->makeDirectory($app) :
            $this->files->makeDirectory($path );
        $this->option('database') ?
            $this->files->makeDirectory($database) :
            false;
            $this->info("success");

        return null;
    }
}
