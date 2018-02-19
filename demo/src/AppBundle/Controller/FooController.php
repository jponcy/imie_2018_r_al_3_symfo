<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Repository\MugRepository;
use AppBundle\Entity\Mug;

class FooController extends Controller
{

    /**
     * @Route(path="/var", methods={"GET"})
     */
    public function barAction()
    {
        /** @var $repo MugRepository */
        $repo = $this->getDoctrine()->getManager()->getRepository(Mug::class);

        $data = $repo->findAll();

        return $this->render('Foo/bar.html.twig', [
            'entities' => $data
        ]);
    }
}
