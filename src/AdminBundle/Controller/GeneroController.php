<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use \SiteBundle\Entity\ProdutoGenero;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/admin/genero")
 */
class GeneroController extends Controller
{
	/**
	 * @Route("/", name="admin_genero_lista")
	 */
	public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $produtoGeneros = $em->getRepository('SiteBundle:ProdutoGenero')->findAll();

		return $this->render('AdminBundle:Genero:generos.html.twig', ['produtoGeneros' => $produtoGeneros]);
	}
    /**
     * Creates a new ProdutoGenero entity.
     *
     * @Route("/new", name="admin_genero_new")
     */
    public function newAction(Request $request)
    {
        $produtoGenero = new \SiteBundle\Entity\ProdutoGenero();
        $form = $this->createForm('AdminBundle\Form\ProdutoGeneroType', $produtoGenero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoGenero);
            $em->flush();

            $descricao = $produtoGenero->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Genero $descricao criado com sucesso.");

            return $this->redirectToRoute('admin_produto_genero_edit', array('id' => $produtoGenero->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->render('AdminBundle:Genero:new.html.twig', array(
            'produtoGenero' => $produtoGenero,
            'form' => $form->createView()
        ));
    }
    /**
     * Displays a form to edit an existing ProdutoGenero entity.
     *
     * @Route("/{id}/edit", name="admin_produto_genero_edit")
     */
    public function editAction(Request $request, ProdutoGenero $produtoGenero)
    {
        $deleteForm = $this->createDeleteForm($produtoGenero);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoGeneroType', $produtoGenero);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoGenero);
            $em->flush();

            $descricao = $produtoGenero->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Genero $descricao alterado com sucesso.");

            return $this->redirectToRoute('admin_produto_genero_edit', array('id' => $produtoGenero->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($editForm));

        return $this->render('AdminBundle:Genero:edit.html.twig', array(
            'produtoGenero' => $produtoGenero,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
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
            ->setAction($this->generateUrl('admin_produto_genero_delete', array('id' => $produtoGenero->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
    }
    /**
     * Deletes a ProdutoGenero entity.
     *
     * @Route("/{id}", name="admin_produto_genero_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoGenero $produtoGenero)
    {
        $descricao = $produtoGenero->getDescricao();

        $form = $this->createDeleteForm($produtoGenero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoGenero);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', "Genero $descricao excluído com sucesso.");
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->redirectToRoute('admin_genero_lista');
    }
}