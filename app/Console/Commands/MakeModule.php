<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create a new module with folders, service provider, routes, controller and model';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $basePath = base_path("Modules/{$name}");

        $folders = [
            'Http/Controllers',
            'Http/Requests',
            'Models',
            'Resources',
            'Routes',
            'Database/Migrations'
        ];

        foreach ($folders as $folder) {
            $path = $basePath . '/' . $folder;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        // ServiceProvider
        $providerPath = $basePath . "/{$name}ServiceProvider.php";
        $providerTemplate = "<?php

namespace Modules\\$name;

use Illuminate\Support\ServiceProvider;

class {$name}ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \$this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        \$this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    public function register()
    {
        //
    }
}";
        File::put($providerPath, $providerTemplate);

        // Route example
        $routePath = $basePath . "/Routes/api.php";
        $routeTemplate = "<?php

use Illuminate\Support\Facades\Route;

Route::prefix('" . strtolower($name) . "')->group(function() {
    // Add your routes here
});";
        File::put($routePath, $routeTemplate);

        // Model
        $modelPath = $basePath . "/Models/{$name}.php";
        $modelTemplate = "<?php

namespace Modules\\$name\Models;

use Illuminate\Database\Eloquent\Model;

class $name extends Model
{
    protected \$fillable = [];
}";
        File::put($modelPath, $modelTemplate);

        // Controller
        $controllerPath = $basePath . "/Http/Controllers/{$name}Controller.php";
        $controllerTemplate = "<?php

namespace Modules\\$name\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class {$name}Controller extends Controller
{
    //
}";
        File::put($controllerPath, $controllerTemplate);

        $this->info("Module {$name} created successfully!");
    }
}
