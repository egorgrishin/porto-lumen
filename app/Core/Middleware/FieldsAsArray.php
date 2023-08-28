<?php

namespace Core\Middleware;

use Closure;
use Core\Parents\BaseMiddleware;
use Laravel\Lumen\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldsAsArray extends BaseMiddleware
{
    /**
     * The name of the key where the keys are located
     */
    private const FIELDS_OFFSET = 'fields';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() === 'GET' && $request->has(self::FIELDS_OFFSET)) {
            $this->parseFieldsToArray($request);
        }

        return $next($request);
    }

    /**
     * Decodes a fields string to array
     */
    private function parseFieldsToArray(Request $request): void
    {
        $fields = $request->input(self::FIELDS_OFFSET);
        if (!is_string($fields)) {
            return;
        }
        if ($this->isJson($fields)) {
            $request->offsetSet(self::FIELDS_OFFSET, json_decode($fields));
            return;
        }
        $request->offsetSet(self::FIELDS_OFFSET, explode(',', $fields));
    }

    /**
     * Determines whether a string is valid JSON
     */
    private function isJson(string $fields): bool
    {
        json_decode($fields);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
