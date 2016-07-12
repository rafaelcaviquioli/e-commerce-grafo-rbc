<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ProdutoController extends Controller
{
    /**
     * @Route("/api/produto")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna os produtos de produtos",
     *  filters={
     *  }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtoProdutos = $em->getRepository('SiteBundle:Produto')->findAll();
        foreach ($produtoProdutos as $produtoProduto) {

            $produtoProduto->transformEntities();
        }
        return new JsonResponse($produtoProdutos);
    }

    /**
     * @Route("/api/produto/{id}")
     * @Method("GET")
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna os dados do produto.",
     *  filters={
     *  {"name"="id", "dataType"="integer"},
     *  }
     * )
     */
    public function getProdutoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository('SiteBundle:Produto')->findById($id);
        if(isset($produto[0]) AND $produto[0] instanceof \SiteBundle\Entity\Produto){
            $produto[0]->transformEntities();

            return new JsonResponse($produto[0]);
        }else{
            return new JsonResponse([]);
        }
    }
    /**
     * @Route("/api/produto_search")
     * @Method("POST")
     * @ApiDoc(
     *  resource=true,
     *  description="Busca de produtos.",
     *  filters={
     *  {"name"="idMarca", "dataType"="integer"},
     *  {"name"="idTamanho", "dataType"="integer"},
     *  {"name"="idCategoria", "dataType"="integer"},
     *  {"name"="idGenero", "dataType"="integer"},
     *  {"name"="idCor", "dataType"="integer"},
     *  }
     * )
     */
    public function buscaProdutoAction(Request $request)
    {
        $idMarca = $request->request->get('idMarca');
        $idTamanho = $request->request->get('idTamanho');
        $idCategoria = $request->request->get('idCategoria');
        $idGenero = $request->request->get('idGenero');
        $idCor = $request->request->get('idCor');

        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('SiteBundle:Produto')->createQueryBuilder('p')
            ->where("p.idMarca = '$idMarca' OR p.idTamanho = '$idTamanho' OR idCategoria = '$idCategoria' OR idGenero = '$idGenero' OR idCor = '$idCor'")
            ->getResult();

        if(!count($produtos)){
            return new JsonResponse([]);
        }

        foreach($produtos as $produto){
            $produto->transformEntities();
        }

        return new JsonResponse($produtos);
    }
}
