<?php

namespace Core\Classes\Illuminate\Foundation\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\ValidatedInput;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Validation\ValidationException;

class FormRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * The container instance.
     */
    protected Container $container;

    /**
     * The URI to redirect to if validation fails.
     */
    protected string $redirect;

    /**
     * Indicates whether validation should stop after the first rule failure.
     */
    protected bool $stopOnFirstFailure = false;

    /**
     * The validator instance.
     */
    protected ?Validator $validator;

    /**
     * Get the validator instance for the request.
     * @throws BindingResolutionException
     */
    protected function getValidatorInstance(): Validator
    {
        if (isset($this->validator)) {
            return $this->validator;
        }

        $factory = $this->container->make(ValidationFactory::class);
        $validator = method_exists($this, 'validator')
            ? $this->container->call([$this, 'validator'], compact('factory'))
            : $this->createDefaultValidator($factory);

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }

        if (method_exists($this, 'after')) {
            $validator->after($this->container->call(
                $this->after(...),
                ['validator' => $validator]
            ));
        }

        $this->setValidator($validator);
        return $this->validator;
    }

    /**
     * Create the default validator instance.
     */
    protected function createDefaultValidator(ValidationFactory $factory): Validator
    {
        $rules = method_exists($this, 'rules')
            ? $this->container->call([$this, 'rules'])
            : [];

        $validator = $factory->make(
            $this->validationData(), $rules,
            $this->messages(), $this->attributes()
        )->stopOnFirstFailure($this->stopOnFirstFailure);

        if ($this->isPrecognitive()) {
            $validator->setRules(
                $this->filterPrecognitiveRules($validator->getRulesWithoutPlaceholders())
            );
        }

        return $validator;
    }

    /**
     * Get data to be validated from the request.
     */
    public function validationData(): array
    {
        return $this->all();
    }

    /**
     * Determine if the request passes the authorization check.
     */
    protected function passesAuthorization(): bool
    {
        if (method_exists($this, 'authorize')) {
            $result = $this->container->call([$this, 'authorize']);
            return $result instanceof Response ? $result->authorize() : $result;
        }
        return true;
    }

    /**
     * Handle a failed validation attempt.
     * @throws ValidationException
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator);
    }

    /**
     * Handle a failed authorization attempt.
     * @throws UnauthorizedException
     */
    protected function failedAuthorization()
    {
        throw new HttpException(403, 'Unauthorized');
    }

    /**
     * Get a validated input container for the validated input.
     */
    public function safe(?array $keys = null): ValidatedInput|array
    {
        return is_array($keys)
            ? $this->validator->safe()->only($keys)
            : $this->validator->safe();
    }

    /**
     * Get the validated data from the request.
     */
    public function validated(array|int|string|null $key = null, mixed $default = null): mixed
    {
        return data_get($this->validator->validated(), $key, $default);
    }

    /**
     * Get the route handling the request.
     */
    public function route($param = null, $default = null): mixed
    {
        $parameters = call_user_func($this->getRouteResolver())[2];
        return array_key_exists($param, $parameters) ? $parameters[$param] : $default;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * Set the Validator instance.
     */
    public function setValidator(Validator $validator): self
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * Set the container implementation.
     */
    public function setContainer(Container $container): self
    {
        $this->container = $container;
        return $this;
    }
}
