<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TamanhoController extends Controller
{
    /**
     * @Route("/api/tamanho")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna os Tamanhos de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoTamanhos = $em->getRepository('SiteBundle:ProdutoTamanho')->findAll([], array('descricao' => 'ASC'));

        return new JsonResponse($produtoTamanhos);
    }
}
