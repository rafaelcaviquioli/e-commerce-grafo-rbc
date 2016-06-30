<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CategoriaController extends Controller
{
    /**
     * @Route("/api/categoria")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna as categorias de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoCategorias = $em->getRepository('SiteBundle:ProdutoCategoria')->find([], array('descricao' => 'ASC'));

        return new JsonResponse($produtoCategorias);
    }
}
