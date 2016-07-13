<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class GeneroController extends Controller
{
    /**
     * @Route("/api/genero")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna as generos de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoGeneros = $em->getRepository('SiteBundle:ProdutoGenero')->findAll([], array('descricao' => 'ASC'));

        return new JsonResponse($produtoGeneros);
    }
}
