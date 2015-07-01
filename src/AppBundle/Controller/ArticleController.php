<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Article;

/**
 * @Route("/articles")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        return array(
                // ...
            );
    }

    /**
     * @Route("/")
     * @Method("POST")
     * @Template()
     */
    public function createAction()
    {

        $request = Request::createFromGlobals();

        $title = $request->request->get('article')['title'];
        $content = $request->request->get('article')['content'];

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);

        $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();

        return new Response('Created article id '.$article->getId() . '<br />' . 'name is ' . $article->getTitle());
    }

    /**
     * @Route("/show/{id}", defaults={"id" = 1})
     * @Template()
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Article');
        $article = $repo->find($id);

        return array(
                'title'     => $article->getTitle(),
                'content'   => $article->getContent()
            );
    }

    /**
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articles = $repo->findAllOrderByName();

        return array(
                'articles'  => $articles
            );
    }

    /**
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function destroyAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
    }
}
