<?php

namespace Core\Classes\Illuminate;

use Core\Classes\Illuminate\Concerns\RoutesRequests;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Laravel\Lumen\Application as LumenApplication;
use Laravel\Lumen\Routing\Router;

class Application extends LumenApplication
{
    use RoutesRequests;

    /**
     * The Router instance.
     * @var Router
     */
    public $router;

    /**
     * Get the path to the given configuration file.
     * If no name is provided, then we'll return the path to the config folder.
     * @param string|null $name
     * @throws FileNotFoundException
     */
    public function getConfigurationPath($name = null): string
    {
        $path = $this->corePath('Configs');
        if ($name) {
            $path .= DIRECTORY_SEPARATOR . "$name.php";
        }
        if (file_exists($path)) {
            return $path;
        }
        throw new FileNotFoundException("Directory [$path] not found");
    }

    /**
     * Get the path to the app directory.
     */
    public function appPath(string $path = ''): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Get the path to the core of the application directory.
     */
    public function corePath(string $path = ''): string
    {
        return $this->appPath() . DIRECTORY_SEPARATOR . 'Core' . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}
