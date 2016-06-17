<?php

namespace SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Entity\ProdutoMarca;
use SiteBundle\Form\ProdutoMarcaType;

/**
 * ProdutoMarca controller.
 *
 * @Route("/produtomarca")
 */
class ProdutoMarcaController extends Controller
{
    /**
     * Lists all ProdutoMarca entities.
     *
     * @Route("/", name="produtomarca_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoMarcas = $em->getRepository('SiteBundle:ProdutoMarca')->findAll();

        return $this->render('produtomarca/index.html.twig', array(
            'produtoMarcas' => $produtoMarcas,
        ));
    }

    /**
     * Creates a new ProdutoMarca entity.
     *
     * @Route("/new", name="produtomarca_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produtoMarca = new ProdutoMarca();
        $form = $this->createForm('SiteBundle\Form\ProdutoMarcaType', $produtoMarca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoMarca);
            $em->flush();

            return $this->redirectToRoute('produtomarca_show', array('id' => $produtoMarca->getId()));
        }

        return $this->render('produtomarca/new.html.twig', array(
            'produtoMarca' => $produtoMarca,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProdutoMarca entity.
     *
     * @Route("/{id}", name="produtomarca_show")
     * @Method("GET")
     */
    public function showAction(ProdutoMarca $produtoMarca)
    {
        $deleteForm = $this->createDeleteForm($produtoMarca);

        return $this->render('produtomarca/show.html.twig', array(
            'produtoMarca' => $produtoMarca,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProdutoMarca entity.
     *
     * @Route("/{id}/edit", name="produtomarca_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProdutoMarca $produtoMarca)
    {
        $deleteForm = $this->createDeleteForm($produtoMarca);
        $editForm = $this->createForm('SiteBundle\Form\ProdutoMarcaType', $produtoMarca);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoMarca);
            $em->flush();

            return $this->redirectToRoute('produtomarca_edit', array('id' => $produtoMarca->getId()));
        }

        return $this->render('produtomarca/edit.html.twig', array(
            'produtoMarca' => $produtoMarca,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProdutoMarca entity.
     *
     * @Route("/{id}", name="produtomarca_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoMarca $produtoMarca)
    {
        $form = $this->createDeleteForm($produtoMarca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoMarca);
            $em->flush();
        }

        return $this->redirectToRoute('produtomarca_index');
    }

    /**
     * Creates a form to delete a ProdutoMarca entity.
     *
     * @param ProdutoMarca $produtoMarca The ProdutoMarca entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProdutoMarca $produtoMarca)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtomarca_delete', array('id' => $produtoMarca->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
