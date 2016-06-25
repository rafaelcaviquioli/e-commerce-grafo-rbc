<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use \SiteBundle\Entity\ProdutoTamanho;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/admin/tamanho")
 */
class TamanhoController extends Controller
{
	/**
	 * @Route("/", name="admin_tamanho_lista")
	 */
	public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $produtoTamanhos = $em->getRepository('SiteBundle:ProdutoTamanho')->findAll();

		return $this->render('AdminBundle:Tamanho:tamanhos.html.twig', ['produtoTamanhos' => $produtoTamanhos]);
	}
    /**
     * Creates a new ProdutoTamanho entity.
     *
     * @Route("/new", name="admin_tamanho_new")
     */
    public function newAction(Request $request)
    {
        $produtoTamanho = new \SiteBundle\Entity\ProdutoTamanho();
        $form = $this->createForm('SiteBundle\Form\ProdutoTamanhoType', $produtoTamanho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoTamanho);
            $em->flush();

            $descricao = $produtoTamanho->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Tamanho $descricao criado com sucesso.");

            return $this->redirectToRoute('admin_produto_tamanho_edit', array('id' => $produtoTamanho->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->render('AdminBundle:Tamanho:new.html.twig', array(
            'produtoTamanho' => $produtoTamanho,
            'form' => $form->createView()
        ));
    }
    /**
     * Displays a form to edit an existing ProdutoTamanho entity.
     *
     * @Route("/{id}/edit", name="admin_produto_tamanho_edit")
     */
    public function editAction(Request $request, ProdutoTamanho $produtoTamanho)
    {
        $deleteForm = $this->createDeleteForm($produtoTamanho);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoTamanhoType', $produtoTamanho);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoTamanho);
            $em->flush();

            $descricao = $produtoTamanho->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Tamanho $descricao alterado com sucesso.");

            return $this->redirectToRoute('admin_produto_tamanho_edit', array('id' => $produtoTamanho->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($editForm));

        return $this->render('AdminBundle:Tamanho:edit.html.twig', array(
            'produtoTamanho' => $produtoTamanho,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
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
            ->setAction($this->generateUrl('admin_produto_tamanho_delete', array('id' => $produtoTamanho->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
    }
    /**
     * Deletes a ProdutoTamanho entity.
     *
     * @Route("/{id}", name="admin_produto_tamanho_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoTamanho $produtoTamanho)
    {
        $descricao = $produtoTamanho->getDescricao();

        $form = $this->createDeleteForm($produtoTamanho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoTamanho);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', "Tamanho $descricao excluído com sucesso.");
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->redirectToRoute('admin_tamanho_lista');
    }
}