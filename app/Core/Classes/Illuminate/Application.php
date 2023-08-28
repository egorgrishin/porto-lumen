<?php

namespace Core\Classes\Illuminate;

use Core\Classes\Illuminate\Concerns\RoutesRequests;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Laravel\Lumen\Application as LumenApplication;
use Laravel\Lumen\Routing\Router;
use ReflectionClass;
use ReflectionException;

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

    /**
     * Returns resolved dependencies
     * @throws BindingResolutionException
     */
    public function getResolvedDependencies(string $abstract): array
    {
        try {
            $reflector = new ReflectionClass($abstract);
        } catch (ReflectionException $exception) {
            throw new BindingResolutionException(
                "Target class [$abstract] does not exist.",
                0,
                $exception
            );
        }

        // If the type is not instantiable, the developer is attempting to resolve
        // an abstract type such as an Interface or Abstract Class and there is
        // no binding registered for the abstractions, so we need to bail out.
        if (!$reflector->isInstantiable()) {
            $this->notInstantiable($abstract);
        }

        // If there are no constructors, that means there are no dependencies then
        // we can just resolve the instances of the objects right away, without
        // resolving any other types or dependencies out of these containers.
        if (is_null($constructor = $reflector->getConstructor())) {
            return [];
        }

        $this->buildStack[] = $abstract;
        $dependencies = $constructor->getParameters();

        // Once we have all the constructor's parameters we can create each of the
        // dependency instances and then use the reflection instances to make a
        // new instance of this class, injecting the created dependencies in.
        try {
            $instances = $this->resolveDependencies($dependencies);
        } catch (BindingResolutionException $exception) {
            array_pop($this->buildStack);
            throw $exception;
        }

        array_pop($this->buildStack);
        return $instances;
    }
}
