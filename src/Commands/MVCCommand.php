<?php

namespace Blumen\Generators\Commands;

class MVCCommand extends BaseGeneratorCommand 
{
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
