<?php
namespace App\Controller;

use App\Entity\IdeaAnswer;
use App\Entity\IdeaAsk;
use App\Form\IdeaAnswerType;
use App\Form\IdeaAskType;
use App\Repository\IdeaAnswerRepository;
use App\Repository\IdeaAskRepository;
use App\Repository\IdeaCategoryRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @var IdeaAskRepository */
    private $ideaAskRepository;
    /** @var IdeaCategoryRepository */
    private $ideaCategoryRepository;
    /** @var IdeaAnswerRepository */
    private $ideaAnswerRepository;

    public function __construct(
        IdeaAskRepository $ideaAskRepository,
        IdeaCategoryRepository $ideaCategoryRepository,
        IdeaAnswerRepository $ideaAnswerRepository
    )
    {
        $this->ideaAskRepository = $ideaAskRepository;
        $this->ideaCategoryRepository = $ideaCategoryRepository;
        $this->ideaAnswerRepository = $ideaAnswerRepository;
    }
    /**
     * @Route(path="/home", name="idea_home")
     */
    public function indexAction()
    {
        $ideaAsks = $this->ideaAskRepository->findAll();
        return $this->render('home/index.html.twig', [
            'ideaAsks' => $ideaAsks
        ]);
    }

    /**
     * @Route(path="/new", name="idea_new")
     * @param Request $request
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function newAction(Request $request)
    {
        $ideaCategories = $this->ideaCategoryRepository->findAll();

        $ideaAsk = new IdeaAsk();
        $formIdeaAsk = $this->createForm(IdeaAskType::class, $ideaAsk, ['ideaCategories' => $ideaCategories]);
        $formIdeaAsk->handleRequest($request);

        if ($formIdeaAsk->isSubmitted()){
            $ideaAsk->setIsSolved(false);
            $this->ideaAskRepository->add($ideaAsk);
            $this->addFlash('success', 'アイデア募集を登録しました。');
            return $this->redirectToRoute('idea_home');
        }
        return $this->render('home/new.html.twig', [
            'formIdeaAsk' => $formIdeaAsk->createView(),
        ]);
    }

    /**
     * @Route(path="/answer/{id}", name="idea_answer")
     * @param Request $request
     * @param IdeaAsk $ideaAsk
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function answerAction(Request $request, IdeaAsk $ideaAsk)
    {
        $ideaAnswer = new IdeaAnswer();
        $formIdeaAnswer = $this->createForm(IdeaAnswerType::class, $ideaAnswer);
        $formIdeaAnswer->handleRequest($request);

        if ($formIdeaAnswer->isSubmitted()){
            $ideaAnswer->setIdeaAsk($ideaAsk);
            $this->ideaAnswerRepository->add($ideaAnswer);
            $this->addFlash('success', 'アイデアを投稿しました。');
            return $this->redirectToRoute('idea_room',['id' => $ideaAsk->getId()]);
        }
        return $this->render('home/answer.html.twig', [
            'ideaAsk' => $ideaAsk,
            'formIdeaAnswer' => $formIdeaAnswer->createView(),
        ]);
    }

    /**
     * @Route(path="/room/{id}", name="idea_room")
     * @param IdeaAsk $ideaAsk
     * @return Response
     */
    public function roomAction(IdeaAsk $ideaAsk)
    {
        $ideaAnswers = $this->ideaAnswerRepository->findBy(['ideaAsk' => $ideaAsk->getId()]);

        return $this->render('home/room.html.twig', [
            'ideaAsk' => $ideaAsk,
            'ideaAnswers' => $ideaAnswers,
        ]);
    }
}