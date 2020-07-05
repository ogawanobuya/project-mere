<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route(path="/user_index/{id}", name="user_index")
     * @param User $user
     * @return Response
     */
    public function indexAction(User $user)
    {
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route(path="/user_edit/{id}", name="user_edit")
     * @param Request $request
     * @param User $user
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function editAction(Request $request, User $user)
    {
        /** @var User $nowUser */
        $nowUser = $this->getUser();

        if ($user->getId() != $nowUser->getId()){
            $this->addFlash('error', 'アクセス許可がありません。');
            return $this->redirectToRoute('idea_home');
        }
        $formUserEdit = $this->createForm(UserEditType::class, $user);
        $formUserEdit->handleRequest($request);

        if ($formUserEdit->isSubmitted()){
            $this->userRepository->modify($user);
            $this->addFlash('success', 'ユーザー情報を編集しました。');
            return $this->redirectToRoute('user_index',['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'formUserEdit' => $formUserEdit->createView(),
        ]);
    }
}
