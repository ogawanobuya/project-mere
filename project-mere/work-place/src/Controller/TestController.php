<?php
namespace App\Controller;

use App\Entity\Test;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route(path="/test", name="test")
     */
    public function indexAction()
    {
        $mere = 1;
        /** @var TestRepository $itemRepository */
        $testRepository = $this->getDoctrine()->getManager()->getRepository(Test::class);
        /** @var Test $testName */
        $testName = $testRepository->find(1);
        return $this->render('test/test.html.twig', [
            'mere' => $testName->getName()
        ]);
    }
}