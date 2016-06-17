<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoVisita;
use SiteBundle\Form\ProdutoVisitaType;

/**
 * ProdutoVisita controller.
 *
 * @Route("/produtovisita")
 */
class ProdutoVisitaController extends Controller
{
    /**
     * Lists all ProdutoVisita entities.
     *
     * @Route("/", name="produtovisita_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoVisitas = $em->getRepository('SiteBundle:ProdutoVisita')->findAll();

        return $this->render('produtovisita/index.html.twig', array(
            'produtoVisitas' => $produtoVisitas,
        ));
    }

    /**
     * Creates a new ProdutoVisita entity.
     *
     * @Route("/new", name="produtovisita_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoVisitum = new ProdutoVisita();
        $form = $this->createForm('SiteBundle\Form\ProdutoVisitaType', $produtoVisitum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoVisitum);
            $em->flush();

            return $this->redirectToRoute('produtovisita_show', array('id' => $produtoVisitum->getId()));
        }

        return $this->render('produtovisita/new.html.twig', array(
            'produtoVisitum' => $produtoVisitum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoVisita entity.
     *
     * @Route("/{id}", name="produtovisita_show")
     * @Method("GET")
     */
    public function showAction(ProdutoVisita $produtoVisitum)
    {
        $deleteForm = $this->createDeleteForm($produtoVisitum);

        return $this->render('produtovisita/show.html.twig', array(
            'produtoVisitum' => $produtoVisitum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoVisita entity.
     *
     * @Route("/{id}/edit", name="produtovisita_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoVisita $produtoVisitum)
    {
        $deleteForm = $this->createDeleteForm($produtoVisitum);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoVisitaType', $produtoVisitum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoVisitum);
            $em->flush();

            return $this->redirectToRoute('produtovisita_edit', array('id' => $produtoVisitum->getId()));
        }

        return $this->render('produtovisita/edit.html.twig', array(
            'produtoVisitum' => $produtoVisitum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoVisita entity.
     *
     * @Route("/{id}", name="produtovisita_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoVisita $produtoVisitum)
    {
        $form = $this->createDeleteForm($produtoVisitum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoVisitum);
            $em->flush();
        }

        return $this->redirectToRoute('produtovisita_index');
    }

    /**
     * Creates a form to delete a ProdutoVisita entity.
     *
     * @param ProdutoVisita $produtoVisitum The ProdutoVisita entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoVisita $produtoVisitum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtovisita_delete', array('id' => $produtoVisitum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
