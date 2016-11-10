<?php

namespace Blumen\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class MVCCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:mvc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the entire path of MVC handlers for a request lifetime.';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Paths where the files will go. Uses convention
     * Keys corresponds to the stubs names
     *
     * stub = [stub, postfix, route]
     *
     * @var array
     */
    static protected $stubs = [
        ['Controller', 'Controller', '/app/Http/Controllers/'],
        ['ControllerDependencies', 'Controller', '/app/Http/Controllers/Dependencies/'],
        ['Service', 'Service', '/app/Services/'],
        ['ServiceDependencies', 'Service', '/app/Services/Dependencies/'],
        ['Repository', 'Repository', '/app/Repositories/'],
        ['Model', '', '/app/Models/'],
        ['Route', '', '/app/Http/Routes/']
    ];

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files) {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {

        foreach(self::$stubs as $stub) {

            $stubName = $stub[0];
            $postfix = $stub[1];
            $path = $stub[2];

            $filename = base_path().$path.$this->getClassName().$postfix.'.php';

            if ($this->alreadyExists($filename)) {
                $this->error($filename.' already exists!');
                return false;
            }

            $file = $this->replaceClassName($this->getStub($stubName));
            $this->makeDirectory($path);
            $this->files->put($filename, $file);

            $this->info($filename.' created successfully.');
        }

        $this->info('All ready!');
        return true;
    }

    /**
     * Determine if the file already exists.
     *
     * @param  string  $filename
     * @return bool
     */
    protected function alreadyExists($filename) {
        return $this->files->exists($filename);
    }

    /**
     * Get the stub file for the generator.
     *
     * @param $name
     * @return string
     */
    protected function getStub($name) {
        $path = __DIR__ . "/../Stubs/$name.stub";
        return $this->files->get($path);
    }

    /**
     * Replace the class name in the stub.
     *
     * @param $stub
     * @return string
     */
    protected function replaceClassName($stub) {
        $c = str_replace('{{class}}', $this->getClassName(), $stub);
        $c = str_replace('{{lowercaseClass}}', lcfirst($this->getClassName()), $c);
        return $c;
    }

    /**
     * Get classname from name argument
     *
     * @return string
     */
    protected function getClassName() {
        return ucwords(camel_case($this->argument('name')));
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $path
     * @return string
     */
    protected function makeDirectory($path) {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            ['name', InputArgument::REQUIRED, 'Entity name']
        ];
    }

}
