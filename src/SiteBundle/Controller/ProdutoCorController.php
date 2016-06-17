<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoCor;
use SiteBundle\Form\ProdutoCorType;

/**
 * ProdutoCor controller.
 *
 * @Route("/produtocor")
 */
class ProdutoCorController extends Controller
{
    /**
     * Lists all ProdutoCor entities.
     *
     * @Route("/", name="produtocor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoCors = $em->getRepository('SiteBundle:ProdutoCor')->findAll();

        return $this->render('produtocor/index.html.twig', array(
            'produtoCors' => $produtoCors,
        ));
    }

    /**
     * Creates a new ProdutoCor entity.
     *
     * @Route("/new", name="produtocor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoCor = new ProdutoCor();
        $form = $this->createForm('SiteBundle\Form\ProdutoCorType', $produtoCor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCor);
            $em->flush();

            return $this->redirectToRoute('produtocor_show', array('id' => $produtoCor->getId()));
        }

        return $this->render('produtocor/new.html.twig', array(
            'produtoCor' => $produtoCor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoCor entity.
     *
     * @Route("/{id}", name="produtocor_show")
     * @Method("GET")
     */
    public function showAction(ProdutoCor $produtoCor)
    {
        $deleteForm = $this->createDeleteForm($produtoCor);

        return $this->render('produtocor/show.html.twig', array(
            'produtoCor' => $produtoCor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoCor entity.
     *
     * @Route("/{id}/edit", name="produtocor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoCor $produtoCor)
    {
        $deleteForm = $this->createDeleteForm($produtoCor);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoCorType', $produtoCor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCor);
            $em->flush();

            return $this->redirectToRoute('produtocor_edit', array('id' => $produtoCor->getId()));
        }

        return $this->render('produtocor/edit.html.twig', array(
            'produtoCor' => $produtoCor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoCor entity.
     *
     * @Route("/{id}", name="produtocor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoCor $produtoCor)
    {
        $form = $this->createDeleteForm($produtoCor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoCor);
            $em->flush();
        }

        return $this->redirectToRoute('produtocor_index');
    }

    /**
     * Creates a form to delete a ProdutoCor entity.
     *
     * @param ProdutoCor $produtoCor The ProdutoCor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoCor $produtoCor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtocor_delete', array('id' => $produtoCor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
