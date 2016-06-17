<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoTamanho;
use SiteBundle\Form\ProdutoTamanhoType;

/**
 * ProdutoTamanho controller.
 *
 * @Route("/produtotamanho")
 */
class ProdutoTamanhoController extends Controller
{
    /**
     * Lists all ProdutoTamanho entities.
     *
     * @Route("/", name="produtotamanho_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoTamanhos = $em->getRepository('SiteBundle:ProdutoTamanho')->findAll();

        return $this->render('produtotamanho/index.html.twig', array(
            'produtoTamanhos' => $produtoTamanhos,
        ));
    }

    /**
     * Creates a new ProdutoTamanho entity.
     *
     * @Route("/new", name="produtotamanho_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoTamanho = new ProdutoTamanho();
        $form = $this->createForm('SiteBundle\Form\ProdutoTamanhoType', $produtoTamanho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoTamanho);
            $em->flush();

            return $this->redirectToRoute('produtotamanho_show', array('id' => $produtoTamanho->getId()));
        }

        return $this->render('produtotamanho/new.html.twig', array(
            'produtoTamanho' => $produtoTamanho,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoTamanho entity.
     *
     * @Route("/{id}", name="produtotamanho_show")
     * @Method("GET")
     */
    public function showAction(ProdutoTamanho $produtoTamanho)
    {
        $deleteForm = $this->createDeleteForm($produtoTamanho);

        return $this->render('produtotamanho/show.html.twig', array(
            'produtoTamanho' => $produtoTamanho,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoTamanho entity.
     *
     * @Route("/{id}/edit", name="produtotamanho_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoTamanho $produtoTamanho)
    {
        $deleteForm = $this->createDeleteForm($produtoTamanho);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoTamanhoType', $produtoTamanho);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoTamanho);
            $em->flush();

            return $this->redirectToRoute('produtotamanho_edit', array('id' => $produtoTamanho->getId()));
        }

        return $this->render('produtotamanho/edit.html.twig', array(
            'produtoTamanho' => $produtoTamanho,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoTamanho entity.
     *
     * @Route("/{id}", name="produtotamanho_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoTamanho $produtoTamanho)
    {
        $form = $this->createDeleteForm($produtoTamanho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoTamanho);
            $em->flush();
        }

        return $this->redirectToRoute('produtotamanho_index');
    }

    /**
     * Creates a form to delete a ProdutoTamanho entity.
     *
     * @param ProdutoTamanho $produtoTamanho The ProdutoTamanho entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoTamanho $produtoTamanho)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtotamanho_delete', array('id' => $produtoTamanho->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
