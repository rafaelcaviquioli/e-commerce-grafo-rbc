<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\Produto;
use SiteBundle\Form\ProdutoType;

/**
 * Produto controller.
 *
 * @Route("/produto")
 */
class ProdutoController extends Controller
{
    /**
     * Lists all Produto entities.
     *
     * @Route("/", name="produto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('SiteBundle:Produto')->findAll();

        return $this->render('produto/index.html.twig', array(
            'produtos' => $produtos,
        ));
    }

    /**
     * Creates a new Produto entity.
     *
     * @Route("/new", name="produto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produto = new Produto();
        $form = $this->createForm('SiteBundle\Form\ProdutoType', $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto_show', array('id' => $produto->getId()));
        }

        return $this->render('produto/new.html.twig', array(
            'produto' => $produto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produto entity.
     *
     * @Route("/{id}", name="produto_show")
     * @Method("GET")
     */
    public function showAction(Produto $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);

        return $this->render('produto/show.html.twig', array(
            'produto' => $produto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produto entity.
     *
     * @Route("/{id}/edit", name="produto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produto $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoType', $produto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto_edit', array('id' => $produto->getId()));
        }

        return $this->render('produto/edit.html.twig', array(
            'produto' => $produto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produto entity.
     *
     * @Route("/{id}", name="produto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produto $produto)
    {
        $form = $this->createDeleteForm($produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produto);
            $em->flush();
        }

        return $this->redirectToRoute('produto_index');
    }

    /**
     * Creates a form to delete a Produto entity.
     *
     * @param Produto $produto The Produto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produto $produto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produto_delete', array('id' => $produto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
