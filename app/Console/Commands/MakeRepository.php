<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = $this->argument('name');

        $className = $this->createClassName($name);

        $filePath = $this->createFilePath($className);


        if (file_exists($filePath)) {
            $this->error("{$className} already exists!");
            return;
        }

        if (!is_dir(app_path('Repositories'))) {
            mkdir(app_path('Repositories'));
        }

        $serviceContents = "<?php\n\nnamespace App\Repositories;\n\nclass {$className}\n{\n    \n}";

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
        return substr($name, -7) === 'Repository' ? '' : 'Repository';
    }

    private function createFilePath(string $className):string
    {
        return app_path("Repositories/{$className}.php");
    }
}
