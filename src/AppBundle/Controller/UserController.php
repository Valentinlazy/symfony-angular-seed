<?php

namespace AppBundle\Controller;

use CoreDomain\DTO\UserDTO;
use CoreDomain\Exception\AccessDeniedException;
use CoreDomain\Exception\ValidationException;
use CoreDomain\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UserController extends Controller
{
    /**
     * @Rest\Post("/users")
     * @Rest\View(serializerGroups="api_user_get", statusCode=201)
     * @ParamConverter(
     *      "userDTO",
     *      converter="fos_rest.request_body",
     *      options={
     *          "deserializationContext"={"groups"="api_user_post"},
     *          "validator"={"groups"={"api_user_post"}}
     *      }
     * )
     */
    public function createUserAction(UserDTO $userDTO, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        return $this->get('app.command_handler')->run(
            $this->get('app.command.add_user'),
            $userDTO
        );
    }

    /**
     * @Rest\Get("/users/{id}")
     * @Rest\View(serializerGroups="api_user_get", statusCode=201)
     */
    public function getUserAction(User $user)
    {
        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedException();
        }
        return $user;
    }

    /**
     * @Rest\Patch("/users/{id}")
     * @Rest\View(serializerGroups="api_user_get", statusCode=200)
     * @ParamConverter(
     *      "userDTO",
     *      converter="fos_rest.request_body",
     *      options={
     *          "deserializationContext"={"groups"="api_user_patch"},
     *          "validator"={"groups"={"api_user_patch"}}
     *      }
     * )
     */
    public function updateProfileAction(User $user, UserDTO $userDTO, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        return $this
            ->get('app.command.update_profile_user')
            ->execute((object)['user' => $user, 'userDTO' => $userDTO])
        ;
    }

    /**
     * @Rest\Post("/users/reset")
     * @Rest\View(statusCode=204)
     */
    public function resetPasswordAction(Request $request)
    {
        $this
            ->get('app.command.reset_password_user')
            ->execute((object)['email' => $request->get('email')])
        ;
    }

}