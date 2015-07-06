<?php

namespace CoreDomain\Exception;

class ValidationException extends DomainException
{
    private $errors;

    public function __construct($message, \Traversable $errors)
    {
        parent::__construct($message, 400);
        $this->errors = $errors;
    }

    /**
     * @return \Traversable|null
     */
    public function getErrors()
    {
        $errors = [];
        /**@var \Symfony\Component\Validator\ConstraintViolation $error */
        foreach ($this->errors as $error) {
            $errors[$error->getPropertyPath()] = $error->getMessage();
        }
        return $errors;
    }
}