<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoGrafo;
use AdminBundle\Form\ProdutoGrafoType;

/**
 * ProdutoGrafo controller.
 *
 * @Route("/admin/produto_grafo")
 */
class ProdutoGrafoController extends Controller
{
    /**
     * Lists all ProdutoGrafo entities.
     *
     * @Route("/", name="admin_produto_grafo_lista")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('SiteBundle:ProdutoGrafo')->findAll();

        return $this->render('AdminBundle:ProdutoGrafo:produtos.html.twig', array(
            'produtos' => $produtos,
        ));
    }

    /**
     * Creates a new ProdutoGrafo entity.
     *
     * @Route("/new", name="admin_produto_grafo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produto = new ProdutoGrafo();
        $form = $this->createForm('AdminBundle\Form\ProdutoGrafoType', $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('admin_produto_grafo_edit', array('id' => $produto->getId()));
        }

        return $this->render('AdminBundle:ProdutoGrafo:new.html.twig', array(
            'produto' => $produto,
            'form' => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing ProdutoGrafo entity.
     *
     * @Route("/{id}/edit", name="admin_produto_grafo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoGrafo $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoGrafoType', $produto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('admin_produto_grafo_edit', array('id' => $produto->getId()));
        }

        return $this->render('AdminBundle:ProdutoGrafo:edit.html.twig', array(
            'produto' => $produto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoGrafo entity.
     *
     * @Route("/{id}", name="admin_produto_grafo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoGrafo $produto)
    {
        $form = $this->createDeleteForm($produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produto);
            $em->flush();
        }

        return $this->redirectToRoute('admin_produto_grafo_lista');
    }

    /**
     * Creates a form to delete a ProdutoGrafo entity.
     *
     * @param ProdutoGrafo $produto The ProdutoGrafo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoGrafo $produto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_produto_grafo_delete', array('id' => $produto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
