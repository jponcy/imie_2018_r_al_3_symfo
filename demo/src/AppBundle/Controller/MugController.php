<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Repository\MugRepository;
use AppBundle\Entity\Mug;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use AppBundle\Form\MugType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/mug")
 */
class MugController extends Controller
{

    /**
     * @Route(path="/", methods={"GET"})
     */
    public function indexAction()
    {
        $data = $this->getRepository()->findAll();

        return $this->render('Mug/index.html.twig', [
            'entities' => $data
        ]);
    }

    /**
     * @Route(path="/new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entity = new Mug();

        return $this->newOrEdit($entity, $request);
    }

    /**
     * @Route("/{id}/edit", methods={"GET", "POST"})
     */
    public function editAction(Mug $entity, Request $request)
    {
        return $this->newOrEdit($entity, $request);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @ParamConverter(class="AppBundle:Mug", name="entity", options={"id": "id"})
     */
    public function showAction(Mug $entity) {
        return $this->render('Mug/show.html.twig', [
            'entity' => $entity
        ]);
    }

    /**
     * @Route("/{id}/delete", methods={"POST"})
     */
    public function deleteAction($id) {
        $entity = $this->getRepository()->find($id);

        if ($entity) {
            $manager = $this->getManager();
            $manager->remove($entity);
            $manager->flush();
        }

        return $this->redirectToRoute('app_mug_index');
    }

    protected function getManager(): EntityManager {
        return $this->getDoctrine()->getManager();
    }

    /**
     *
     */
    protected function getRepository(): MugRepository
    {
        return $this->getManager()->getRepository(Mug::class);
    }

    protected function newOrEdit(Mug $entity, Request $request): Response {
        $form = $this->createForm(MugType::class, $entity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getManager();

            $manager->persist($entity);
            $manager->flush();

            return $this->redirectToRoute('app_mug_index');
        }

        return $this->render('Mug/new.html.twig', [
            'form' => $form->createView()
        ]);
    }






}
