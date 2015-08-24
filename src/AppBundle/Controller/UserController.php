<?php

namespace AppBundle\Controller;

use CoreDomain\DTO\ProfileDTO;
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
            $this->get('app.command.user_add'),
            $userDTO
        );
    }

    /**
     * @Rest\Get("/users/{id}")
     * @Rest\View(serializerGroups="api_user_get", statusCode=200)
     */
    public function getUserAction(User $user)
    {
        $this->checkAccess($user);
        return $user;
    }

    /**
     * @Rest\Patch("/users/{id}")
     * @Rest\View(serializerGroups="api_user_get", statusCode=200)
     * @ParamConverter(
     *      "profileDTO",
     *      converter="fos_rest.request_body",
     *      options={
     *          "deserializationContext"={"groups"="api_user_patch"},
     *          "validator"={"groups"={"api_user_patch"}}
     *      }
     * )
     */
    public function updateProfileAction(User $user, ProfileDTO $profileDTO, ConstraintViolationListInterface $validationErrors)
    {
        $this->checkAccess($user);
        if (count($validationErrors) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        return $this
            ->get('app.command.user_update_profile')
            ->execute((object)['user' => $user, 'profileDTO' => $profileDTO])
        ;
    }

    /**
     * @Rest\Post("/users/reset")
     * @Rest\View(statusCode=204)
     */
    public function resetPasswordAction(Request $request)
    {
        $this
            ->get('app.command.user_reset_password')
            ->execute((object)['email' => $request->get('email')])
        ;
    }

    private function checkAccess(User $user)
    {
        $currentUser = $this->getUser();
        if (!$currentUser || $currentUser->getId() !== $user->getId()) {
            throw new AccessDeniedException();
        }
    }
}
