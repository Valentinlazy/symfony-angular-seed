<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use CoreDomain\DTO\UserDTO;
use CoreDomain\Exception\ValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class SessionController extends Controller
{
    /**
     * @Rest\Post("/sessions")
     * @Rest\View(serializerGroups="api_session_get", statusCode=201)
     * @ParamConverter(
     *      "userDTO",
     *      converter="fos_rest.request_body",
     *      options={
     *          "deserializationContext"={"groups"="api_session_post"},
     *          "validator"={"groups"={"api_session_post"}}
     *      }
     * )
     */
    public function createSessionAction(UserDTO $userDTO, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        return $this->get('app.command_handler')->run(
            $this->get('app.command.add_session'),
            $userDTO
        );
    }
}