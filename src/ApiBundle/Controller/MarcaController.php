<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MarcaController extends Controller
{
    /**
     * @Route("/api/marca")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna as marcas de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoMarcas = $em->getRepository('SiteBundle:ProdutoMarca')->findAll([], array('descricao' => 'ASC'));

        return new JsonResponse($produtoMarcas);
    }
}
