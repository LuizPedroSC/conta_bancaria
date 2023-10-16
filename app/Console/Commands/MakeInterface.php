<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeInterface extends Command
{
    protected $signature = 'make:interface {name}';

    protected $description = 'Create a new interface class';

    public function handle()
    {
        $name = $this->argument('name');
        $className = $this->createClassName($name);
        $filePath = $this->createFilePath($className);

        if (file_exists($filePath)) {
            $this->error("{$className} already exists!");
            return;
        }

        if (!is_dir(app_path('Interfaces'))) {
            mkdir(app_path('Interfaces'));
        }

        $serviceContents = "<?php\n\nnamespace App\Interfaces;\n\ninterface {$className}\n{\n    \n}";

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
        return substr($name, -3) === 'Interface' ? '' : 'Interface';
    }

    private function createFilePath(string $className):string
    {
        return app_path("Interfaces/{$className}.php");
    }
}
