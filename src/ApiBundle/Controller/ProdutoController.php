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
     *  {"name"="descricao", "dataType"="string"},
     *  {"name"="categoria", "dataType"="integer"},
     *  {"name"="marcas", "dataType"="Array<integer>"},
     *  {"name"="tamanhos", "dataType"="Array<integer>"},
     *  {"name"="generos", "dataType"="Array<integer>"},
     *  {"name"="cores", "dataType"="Array<integer>"},
     *  }
     * )
     */
    public function buscaProdutoAction(Request $request)
    {
        $descricao = $request->request->get('descricao');
        $categoria = $request->request->get('categoria');

        $marcas = explode(',', $request->request->get('marcas'));
        $tamanhos = explode(',', $request->request->get('tamanhos'));
        $generos = explode(',', $request->request->get('generos'));
        $cores = explode(',', $request->request->get('cores'));

        $sql = [];

        $cores = array_filter($cores);
        if(count($cores)){
            $sqlCor = [];
            foreach ($cores as $cor){
                $sqlCor[] = "p.idcor = '$cor'";
            }
            $sqlCor = " (" . implode(' OR ', $sqlCor) . ") ";
        }
        $generos = array_filter($generos);
        if(count($generos)){
            $sqlGenero = [];
            foreach ($generos as $genero){
                $sqlGenero[] = "p.idgenero = '$genero'";
            }
            $sqlGenero = " (" . implode(' OR ', $sqlGenero) . ") ";
        }

        $marcas = array_filter($marcas);
        if(count($marcas)){
            $sqlMarcas = [];
            foreach ($marcas as $marca){
                $sqlMarcas[] = "p.idmarca = '$marca'";
            }
            $sqlMarcas = " (" . implode(' OR ', $sqlMarcas) . ") ";
        }

        $tamanhos = array_filter($tamanhos);
        if(count($tamanhos)){
            $sqlTamanhos = [];
            foreach ($tamanhos as $tamanho){
                $sqlTamanhos[] = "p.idtamanho = '$tamanho'";
            }
            $sqlTamanhos = " (" . implode(' OR ', $sqlTamanhos) . ") ";
        }

        $sql[] = isset($sqlMarcas)       ? $sqlMarcas : null;
        $sql[] = isset($sqlTamanhos)     ? $sqlTamanhos : null;
        $sql[] = isset($sqlGenero)       ? $sqlGenero : null;
        $sql[] = isset($sqlCor)          ? $sqlCor : null;

        $sql[] = !empty($descricao)      ? "p.descricao LIKE '%$descricao%'" : null;
        $sql[] = !empty($categoria)      ? "p.idcategoria = '$categoria'" : null;

        $sql = implode(' AND ', array_filter($sql));

        $em = $this->getDoctrine()->getManager();
        if(empty($sql)){
            $produtos = $em->getRepository('SiteBundle:Produto')->findAll();
        }else {
            $produtos = $em->getRepository('SiteBundle:Produto')->createQueryBuilder('p')
                ->where($sql)
                ->getQuery()->getResult();
        }
        if(!count($produtos)){
            return new JsonResponse([]);
        }

        foreach($produtos as $produto){
            $produto->transformEntities();
        }

        return new JsonResponse($produtos);
    }

    /**
     * @Route("/api/find-rbc/{idProduto}")
     * @Method("GET")
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna os produtos relacionados ao produto passado pelo parâmetro utilizando tecnica RBC.",
     * )
     */
    public function findRbc($idProduto)
    {

      try{

          $data = [];

          $em = $this->getDoctrine();

          $produtos = $em->getEntityManager()
                ->createQuery('select p from SiteBundle:Produto p')
                ->setMaxResults(3)
                ->getResult();

           foreach($produtos as $produto){
             $produto->transformEntities();
             array_push($data, $produto);
           }
            
       }catch(\Exception $e){
            error_log("request of the product with problem, call component error");
       }

       return new JsonResponse($data);
    }
}
