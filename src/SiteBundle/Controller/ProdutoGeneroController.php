<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoGenero;
use SiteBundle\Form\ProdutoGeneroType;

/**
 * ProdutoGenero controller.
 *
 * @Route("/produtogenero")
 */
class ProdutoGeneroController extends Controller
{
    /**
     * Lists all ProdutoGenero entities.
     *
     * @Route("/", name="produtogenero_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoGeneros = $em->getRepository('SiteBundle:ProdutoGenero')->findAll();

        return $this->render('produtogenero/index.html.twig', array(
            'produtoGeneros' => $produtoGeneros,
        ));
    }

    /**
     * Creates a new ProdutoGenero entity.
     *
     * @Route("/new", name="produtogenero_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoGenero = new ProdutoGenero();
        $form = $this->createForm('SiteBundle\Form\ProdutoGeneroType', $produtoGenero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoGenero);
            $em->flush();

            return $this->redirectToRoute('produtogenero_show', array('id' => $produtoGenero->getId()));
        }

        return $this->render('produtogenero/new.html.twig', array(
            'produtoGenero' => $produtoGenero,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoGenero entity.
     *
     * @Route("/{id}", name="produtogenero_show")
     * @Method("GET")
     */
    public function showAction(ProdutoGenero $produtoGenero)
    {
        $deleteForm = $this->createDeleteForm($produtoGenero);

        return $this->render('produtogenero/show.html.twig', array(
            'produtoGenero' => $produtoGenero,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoGenero entity.
     *
     * @Route("/{id}/edit", name="produtogenero_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoGenero $produtoGenero)
    {
        $deleteForm = $this->createDeleteForm($produtoGenero);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoGeneroType', $produtoGenero);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoGenero);
            $em->flush();

            return $this->redirectToRoute('produtogenero_edit', array('id' => $produtoGenero->getId()));
        }

        return $this->render('produtogenero/edit.html.twig', array(
            'produtoGenero' => $produtoGenero,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoGenero entity.
     *
     * @Route("/{id}", name="produtogenero_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoGenero $produtoGenero)
    {
        $form = $this->createDeleteForm($produtoGenero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoGenero);
            $em->flush();
        }

        return $this->redirectToRoute('produtogenero_index');
    }

    /**
     * Creates a form to delete a ProdutoGenero entity.
     *
     * @param ProdutoGenero $produtoGenero The ProdutoGenero entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoGenero $produtoGenero)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtogenero_delete', array('id' => $produtoGenero->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
