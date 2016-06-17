<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoCategoria;
use SiteBundle\Form\ProdutoCategoriaType;

/**
 * ProdutoCategoria controller.
 *
 * @Route("/produtocategoria")
 */
class ProdutoCategoriaController extends Controller
{
    /**
     * Lists all ProdutoCategoria entities.
     *
     * @Route("/", name="produtocategoria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoCategorias = $em->getRepository('SiteBundle:ProdutoCategoria')->findAll();

        return $this->render('produtocategoria/index.html.twig', array(
            'produtoCategorias' => $produtoCategorias,
        ));
    }

    /**
     * Creates a new ProdutoCategoria entity.
     *
     * @Route("/new", name="produtocategoria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoCategorium = new ProdutoCategoria();
        $form = $this->createForm('SiteBundle\Form\ProdutoCategoriaType', $produtoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCategorium);
            $em->flush();

            return $this->redirectToRoute('produtocategoria_show', array('id' => $produtoCategorium->getId()));
        }

        return $this->render('produtocategoria/new.html.twig', array(
            'produtoCategorium' => $produtoCategorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoCategoria entity.
     *
     * @Route("/{id}", name="produtocategoria_show")
     * @Method("GET")
     */
    public function showAction(ProdutoCategoria $produtoCategorium)
    {
        $deleteForm = $this->createDeleteForm($produtoCategorium);

        return $this->render('produtocategoria/show.html.twig', array(
            'produtoCategorium' => $produtoCategorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoCategoria entity.
     *
     * @Route("/{id}/edit", name="produtocategoria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoCategoria $produtoCategorium)
    {
        $deleteForm = $this->createDeleteForm($produtoCategorium);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoCategoriaType', $produtoCategorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCategorium);
            $em->flush();

            return $this->redirectToRoute('produtocategoria_edit', array('id' => $produtoCategorium->getId()));
        }

        return $this->render('produtocategoria/edit.html.twig', array(
            'produtoCategorium' => $produtoCategorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoCategoria entity.
     *
     * @Route("/{id}", name="produtocategoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoCategoria $produtoCategorium)
    {
        $form = $this->createDeleteForm($produtoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoCategorium);
            $em->flush();
        }

        return $this->redirectToRoute('produtocategoria_index');
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
