<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');

        $className = $this->createClassName($name);

        $filePath = $this->createFilePath($className);


        if (file_exists($filePath)) {
            $this->error("{$className} already exists!");
            return;
        }

        if (!is_dir(app_path('Services'))) {
            mkdir(app_path('Services'));
        }

        $serviceContents = "<?php\n\nnamespace App\Services;\n\nclass {$className}\n{\n    \n}";

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
        return substr($name, -7) === 'Service' ? '' : 'Service';
    }

    private function createFilePath(string $className):string
    {
        return app_path("Services/{$className}.php");
    }
}
