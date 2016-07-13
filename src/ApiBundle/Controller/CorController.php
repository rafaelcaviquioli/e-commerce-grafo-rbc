<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CorController extends Controller
{
    /**
     * @Route("/api/cor")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna as cores de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoCores = $em->getRepository('SiteBundle:ProdutoCor')->findAll([], array('descricao' => 'ASC'));

        return new JsonResponse($produtoCores);
    }
}
