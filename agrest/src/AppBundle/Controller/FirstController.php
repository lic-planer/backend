<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class FirstController extends Controller
{
    /**
     * @Route("/", name="first_contro")
     */
    public function tryAction()
    {
        return $this->render('first/index.html.twig');
    }
    /**
     * @Route("/first/create", name="first_create")
     */
    public function createAction(Request $request)
    {
        return $this->render('first/create.html.twig');
    }
    /**
     * @Route("/first/edit/{id}", name="first_edit")
     */
    public function editAction($id, Request $request)
    {
        return $this->render('first/edit.html.twig');
    }
    /**
     * @Route("/first/details/{id}", name="first_details")
     */
    public function detailsAction($id)
    {
        return $this->render('first/details.html.twig');
    }
}
