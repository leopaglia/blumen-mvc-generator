<?php

namespace Blumen\Generators\Commands;

class RESTCommand extends BaseGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:rest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the entire path of REST handlers for a request lifetime.';

    /**
     * The location of the routing array
     *
     * @var string $routingPath
     */
    protected $routingPath = '../Config/RESTFileRouting.php';

    /**
     * @inheritdoc
     */
    protected function exec() {
        foreach ($this->routing as $type) {
            foreach($type as $file) {
                $stubname = $file['stub'];
                $filename = $file['filename'];
                $path = $file['path'];
                $this->createFile($stubname, $filename, $path);
            }
        }
    }
}
