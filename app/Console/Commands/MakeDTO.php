<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDTO extends Command
{
    protected $signature = 'make:dto {name}';

    protected $description = 'Create a new dto class';

    public function handle()
    {
        $name = $this->argument('name');

        $className = $this->createClassName($name);

        $filePath = $this->createFilePath($className);


        if (file_exists($filePath)) {
            $this->error("{$className} already exists!");
            return;
        }

        if (!is_dir(app_path('DTO'))) {
            mkdir(app_path('DTO'));
        }

        $serviceContents = "<?php\n\nnamespace App\DTO;\n\nclass {$className}\n{\n    \n}";

        file_put_contents($filePath, $serviceContents);

        $this->info("{$className} created successfully!");
    }

    private function createClassName(string $name): string
    {
        $sufixo = $this->padronizarNomeclatura($name);
        return $name . $sufixo;        
    }

    private function padronizarNomeclatura(string $name): string
    {
        return substr($name, -3) === 'DTO' ? '' : 'DTO';
    }

    private function createFilePath(string $className):string
    {
        return app_path("DTO/{$className}.php");
    }
}
