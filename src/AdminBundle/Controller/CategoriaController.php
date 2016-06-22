<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class CategoriaController extends Controller
{
	/**
	 * @Route("/categoria", name="admin_categoria_lista")
	 */
	public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $produtoCategorias = $em->getRepository('SiteBundle:ProdutoCategoria')->findAll();

		return $this->render('AdminBundle:Categoria:categorias.html.twig', ['produtoCategorias' => $produtoCategorias]);
	}
    /**
     * Creates a new ProdutoCategoria entity.
     *
     * @Route("/new", name="admin_categoria_new")
     */
    public function newAction(Request $request)
    {
        $produtoCategoria = new \SiteBundle\Entity\ProdutoCategoria();
        $form = $this->createForm('SiteBundle\Form\ProdutoCategoriaType', $produtoCategoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCategoria);
            $em->flush();

            return $this->redirectToRoute('admin_produto_categoria_show', array('id' => $produtoCategoria->getId()));
        }

        return $this->render('AdminBundle:Categoria:new.html.twig', array(
            'produtoCategoria' => $produtoCategoria,
            'form' => $form->createView(),
        ));
    }
}