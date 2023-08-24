<?php

namespace Core\Classes\Illuminate\Concerns;

use Laravel\Lumen\Concerns\RoutesRequests as LumenRoutesRequests;

trait RoutesRequests
{
    use LumenRoutesRequests;

    /**
     * Call the Closure or invokable on the array based route.
     */
    protected function callActionOnArrayBasedRoute($routeInfo): mixed
    {
        return parent::callActionOnArrayBasedRoute(
            $this->prepareLaravelRouteAction($routeInfo)
        );
    }

    /**
     * Forms the actions of routes set as in Laravel
     */
    private function prepareLaravelRouteAction(array $routeInfo): array
    {
        $action = $routeInfo[1];
        if ($this->actionAsInLaravel($action)) {
            $routeInfo[1] = ['uses' => "$action[0]@$action[1]"];
        } elseif (isset($action['uses']) && $this->actionAsInLaravel($action['uses'])) {
            $routeInfo[1]['uses'] = $action['uses'][0] . '@' . $action['uses'][1];
        }

        return $routeInfo;
    }

    /**
     * Route action is set as in Laravel
     */
    private function actionAsInLaravel(array $action): bool
    {
        return count($action) === 2 && isset($action[0], $action[1]);
    }
}
