<?php

namespace Blumen\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

abstract class BaseGeneratorCommand extends Command
{
    /**
     * Files created until now. Used for cleanup in case of errors.
     *
     * @var array
     */
    protected $created = [];

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The file routing array.
     * Paths where the files will go, separated by layer. Enforces convention
     *
     * @var array $routing
     */
    protected $routing;

    /**
     * The location of the routing array
     *
     * @var string $routingPath
     */
    protected $routingPath;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->routing = require __DIR__ . $this->routingPath;
    }

    /**
     * The execution of the command.
     * Wrapped in the fire function with error handling.
     * Should push created files to the $created arrays for correct fallback if something happens.
     */
    abstract protected function exec();

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function fire()
    {
        try {
            $this->exec();
            $this->info('All ready!');
            return true;
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
            $this->info('Cleaning up created files...');
            $this->cleanup();
            return false;
        }
    }

    /**
     * Delete already created files in case of error.
     */
    protected function cleanup()
    {
        try {
            $this->files->delete($this->created);
        }
        catch (\Exception $e) {
            $this->info("Sorry, could not delete the created files... :(");
        }
    }

    /**
     * Determine if the file already exists.
     *
     * @param  string  $filename
     * @return bool
     */
    protected function alreadyExists($filename)
    {
        return $this->files->exists($filename);
    }

    /**
     * Get the stub file for the generator.
     *
     * @param $name
     * @return string
     */
    protected function getStub($name)
    {
        $path = __DIR__ . "/../Stubs/$name.stub";
        return $this->files->get($path);
    }

    /**
     * Replace the class name in the stub.
     *
     * @param $stub
     * @return string
     */
    protected function replaceClassName($stub)
    {
        $c = str_replace('{{class}}', $this->getClassName(), $stub);
        $c = str_replace('{{lowercaseClass}}', lcfirst($this->getClassName()), $c);
        return $c;
    }

    /**
     * Get classname from name argument
     *
     * @return string
     */
    protected function getClassName()
    {
        return ucwords(camel_case($this->argument('name')));
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Create file (creates directory if necessary).
     * Replaces templated classname from path, filename and content.
     *
     * @param $stubname
     * @param $filename
     * @param $path
     * @throws \Exception
     */
    protected function createFile($stubname, $filename, $path)
    {
        $path = base_path() . $this->replaceClassName($path);
        $filename = $this->replaceClassName($filename);
        $content = $this->replaceClassName($this->getStub($stubname));

        $fullpath = $path.'/'.$filename;

        if ($this->alreadyExists($fullpath)) {
            throw new \Exception($fullpath.' already exists!');
        }

        $this->makeDirectory($path);
        $this->files->put($fullpath, $content);

        $this->info($fullpath.' created successfully.');
        $this->created[] = $fullpath;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Entity name']
        ];
    }
}
