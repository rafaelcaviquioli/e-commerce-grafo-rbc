<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use \SiteBundle\Entity\ProdutoMarca;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/admin/marca")
 */
class MarcaController extends Controller
{
	/**
	 * @Route("/", name="admin_marca_lista")
	 */
	public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $produtoMarcas = $em->getRepository('SiteBundle:ProdutoMarca')->findAll();

		return $this->render('AdminBundle:Marca:marcas.html.twig', ['produtoMarcas' => $produtoMarcas]);
	}
    /**
     * Creates a new ProdutoMarca entity.
     *
     * @Route("/new", name="admin_marca_new")
     */
    public function newAction(Request $request)
    {
        $produtoMarca = new \SiteBundle\Entity\ProdutoMarca();
        $form = $this->createForm('SiteBundle\Form\ProdutoMarcaType', $produtoMarca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoMarca);
            $em->flush();

            $descricao = $produtoMarca->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Marca $descricao criada com sucesso.");

            return $this->redirectToRoute('admin_produto_marca_edit', array('id' => $produtoMarca->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->render('AdminBundle:Marca:new.html.twig', array(
            'produtoMarca' => $produtoMarca,
            'form' => $form->createView()
        ));
    }
    /**
     * Displays a form to edit an existing ProdutoMarca entity.
     *
     * @Route("/{id}/edit", name="admin_produto_marca_edit")
     */
    public function editAction(Request $request, ProdutoMarca $produtoMarca)
    {
        $deleteForm = $this->createDeleteForm($produtoMarca);
        $editForm = $this->createForm('AdminBundle\Form\ProdutoMarcaType', $produtoMarca);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produtoMarca);
            $em->flush();

            $descricao = $produtoMarca->getDescricao();

            $this->get('session')->getFlashBag()->set('success', "Marca $descricao alterada com sucesso.");

            return $this->redirectToRoute('admin_produto_marca_edit', array('id' => $produtoMarca->getId()));
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($editForm));

        return $this->render('AdminBundle:Marca:edit.html.twig', array(
            'produtoMarca' => $produtoMarca,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
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
            ->setAction($this->generateUrl('admin_produto_marca_delete', array('id' => $produtoMarca->getId())))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
    }
    /**
     * Deletes a ProdutoMarca entity.
     *
     * @Route("/{id}", name="admin_produto_marca_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProdutoMarca $produtoMarca)
    {
        $descricao = $produtoMarca->getDescricao();

        $form = $this->createDeleteForm($produtoMarca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produtoMarca);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', "Marca $descricao excluída com sucesso.");
        }

        $this->get('session')->getFlashBag()->set('error', \AdminBundle\Service\FormError::toFlashBag($form));

        return $this->redirectToRoute('admin_marca_lista');
    }
}