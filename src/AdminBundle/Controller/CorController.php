<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use \SiteBundle\Entity\ProdutoCor;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/admin/cor")
 */
class CorController extends Controller
{
    /**
     * @Route("/", name="admin_cor_lista")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $produtoCores = $em->getRepository('SiteBundle:ProdutoCor')->findAll();

        return $this->render('AdminBundle:Cor:cores.html.twig', ['produtoCores' => $produtoCores]);
    }
    /**
     * Creates a new ProdutoCor entity.
     *
     * @Route("/new", name="admin_cor_new")
     */
    public function newAction(Request $request)
    {
        $produtoCor = new \SiteBundle\Entity\ProdutoCor();
        $form = $this->createForm('AdminBundle\Form\ProdutoCorType', $produtoCor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCor);
            $em->flush();

            $descricao = $produtoCor->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Cor $descricao criada com sucesso.");

            return $this->redirectToRoute('admin_produto_cor_edit', array('id' => $produtoCor->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->render('AdminBundle:Cor:new.html.twig', array(
            'produtoCor' => $produtoCor,
            'form' => $form->createView()
        ));
    }
    /**
     * Displays a form to edit an existing ProdutoCor entity.
     *
     * @Route("/{id}/edit", name="admin_produto_cor_edit")
     */
    public function editAction(Request $request, ProdutoCor $produtoCor)
    {
        $deleteForm = $this->createDeleteForm($produtoCor);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoCorType', $produtoCor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoCor);
            $em->flush();

            $descricao = $produtoCor->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Cor $descricao alterada com sucesso.");

            return $this->redirectToRoute('admin_produto_cor_edit', array('id' => $produtoCor->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($editForm));

        return $this->render('AdminBundle:Cor:edit.html.twig', array(
            'produtoCor' => $produtoCor,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
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
            ->setAction($this->generateUrl('admin_produto_cor_delete', array('id' => $produtoCor->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
            ;
    }
    /**
     * Deletes a ProdutoCor entity.
     *
     * @Route("/{id}", name="admin_produto_cor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoCor $produtoCor)
    {
        $descricao = $produtoCor->getDescricao();

        $form = $this->createDeleteForm($produtoCor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoCor);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', "Cor $descricao excluída com sucesso.");
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->redirectToRoute('admin_cor_lista');
    }
}