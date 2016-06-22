<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \SiteBundle\Entity\ProdutoCategoria;

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
    /**
     * Displays a form to edit an existing ProdutoCategoria entity.
     *
     * @Route("/{id}/edit", name="admin_produto_categoria_edit")
     */
    public function editAction(Request $request, ProdutoCategoria $produtoCategorium)
    {
        $deleteForm = $this->createDeleteForm($produtoCategorium);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoCategoriaType', $produtoCategorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCategorium);
            $em->flush();

            return $this->redirectToRoute('admin_produto_categoria_edit', array('id' => $produtoCategorium->getId()));
        }

        return $this->render('AdminBundle:Categoria:edit.html.twig', array(
            'produtoCategorium' => $produtoCategorium,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Creates a form to delete a ProdutoCategoria entity.
     *
     * @param ProdutoCategoria $produtoCategorium The ProdutoCategoria entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoCategoria $produtoCategorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtocategoria_delete', array('id' => $produtoCategorium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}