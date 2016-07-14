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
     * )
     */
    public function getProdutoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository('SiteBundle:Produto')->findById($id);
        if (isset($produto[0]) AND $produto[0] instanceof \SiteBundle\Entity\Produto) {
            $produto[0]->transformEntities();

            return new JsonResponse($produto[0]);
        } else {
            return new JsonResponse([]);
        }
    }

    /**
     * @Route("/api/produto/visita/{id}/{token}")
     * @Method("GET")
     * @ApiDoc(
     *  resource=true,
     *  description="Registra visita no produto.",
     * )
     */
    public function registraVisita($id, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('SiteBundle:Usuario')->findOneByToken($token);
        if (!$usuario instanceof \SiteBundle\Entity\Usuario) {
            return new JsonResponse(['status' => false, 'message' => "Usuário $token não identificado."]);
        }

        $produto = $em->getRepository('SiteBundle:Produto')->findOneById($id);
        if ($produto instanceof \SiteBundle\Entity\Produto) {

            $visita = new \SiteBundle\Entity\ProdutoVisita();
            $visita
                ->setDatacadastro(new \DateTime())
                ->setIdproduto($produto)
                ->setIdusuario($usuario);

            $em = $this->getDoctrine()->getManager();
            $em->persist($visita);
            $em->flush();

            return new JsonResponse(['status' => true, 'message' => 'Visita registrada']);
        } else {
            return new JsonResponse(['status' => false, 'message' => "Produto $id não encontrado."]);
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
        if (count($cores)) {
            $sqlCor = [];
            foreach ($cores as $cor) {
                $sqlCor[] = "p.idcor = '$cor'";
            }
            $sqlCor = " (" . implode(' OR ', $sqlCor) . ") ";
        }
        $generos = array_filter($generos);
        if (count($generos)) {
            $sqlGenero = [];
            foreach ($generos as $genero) {
                $sqlGenero[] = "p.idgenero = '$genero'";
            }
            $sqlGenero = " (" . implode(' OR ', $sqlGenero) . ") ";
        }

        $marcas = array_filter($marcas);
        if (count($marcas)) {
            $sqlMarcas = [];
            foreach ($marcas as $marca) {
                $sqlMarcas[] = "p.idmarca = '$marca'";
            }
            $sqlMarcas = " (" . implode(' OR ', $sqlMarcas) . ") ";
        }

        $tamanhos = array_filter($tamanhos);
        if (count($tamanhos)) {
            $sqlTamanhos = [];
            foreach ($tamanhos as $tamanho) {
                $sqlTamanhos[] = "p.idtamanho = '$tamanho'";
            }
            $sqlTamanhos = " (" . implode(' OR ', $sqlTamanhos) . ") ";
        }

        $sql[] = isset($sqlMarcas) ? $sqlMarcas : null;
        $sql[] = isset($sqlTamanhos) ? $sqlTamanhos : null;
        $sql[] = isset($sqlGenero) ? $sqlGenero : null;
        $sql[] = isset($sqlCor) ? $sqlCor : null;

        $sql[] = !empty($descricao) ? "p.descricao LIKE '%$descricao%'" : null;
        $sql[] = !empty($categoria) ? "p.idcategoria = '$categoria'" : null;

        $sql = implode(' AND ', array_filter($sql));

        $em = $this->getDoctrine()->getManager();
        if (empty($sql)) {
            $produtos = $em->getRepository('SiteBundle:Produto')->findAll();
        } else {
            $produtos = $em->getRepository('SiteBundle:Produto')->createQueryBuilder('p')
                ->where($sql)
                ->getQuery()->getResult();
        }
        if (!count($produtos)) {
            return new JsonResponse([]);
        }

        foreach ($produtos as $produto) {
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

        try {

            $data = [];

            $em = $this->getDoctrine();

            $produtos = $em->getEntityManager()
                ->createQuery('select p from SiteBundle:Produto p')
                ->setMaxResults(3)
                ->getResult();

            foreach ($produtos as $produto) {
                $produto->transformEntities();
                array_push($data, $produto);
            }

        } catch (\Exception $e) {
            error_log("request of the product with problem, call component error");
        }

        return new JsonResponse($data);
    }


    /**
     * @Route("/api/find-produto-grafo/{token}")
     * @Method("GET")
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna os produtos relacionados aos produtos visitados pelo usuário",
     * )
     */
    public function findProdutoGrafo($token)
    {
        //Para cada produto visitado será retornado no máximo três outros produtos parecidos.
        $adjacenciasPorVisita = 3;
        $utilizarUltimasVisitas = 3;

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT v FROM SiteBundle\Entity\ProdutoVisita v INNER JOIN SiteBundle\Entity\Usuario u WITH u.id = v.idusuario WHERE u.token = \'' . $token . '\' ORDER BY v.id DESC')->setMaxResults($utilizarUltimasVisitas);

        $visitas = $query->getResult();

        if(!count($visitas)){
            return new JsonResponse([]);
        }

        $produtos = [];

        $grafo = $this->getGrafoProduto();
        if(!$grafo){
            return new JsonResponse($produtos);
        }

        foreach ($visitas as $visita) {
            $adjacencias = $grafo->getAdjascencias($visita->getIdproduto()->getId(), $adjacenciasPorVisita);
            if(!count($adjacencias)){
                continue;
            }

            foreach ($adjacencias as $idProduto) {
                $produtos[] = $em->getRepository('SiteBundle:Produto')->findOneById($idProduto);
            }

        }

        return new JsonResponse($produtos);
    }

    private function getGrafoProduto()
    {
        $produtosGrafos = $this->getDoctrine()->getManager()->getRepository('SiteBundle:ProdutoGrafo')->findAll();
        if (!count($produtosGrafos)) {
            return false;
        }

        $grafo = new \ApiBundle\Service\Grafo();
        foreach ($produtosGrafos as $produtoGrafo) {
            $grafo->adicionarAresta(
                $produtoGrafo->getIdproduto1()->getId(),
                $produtoGrafo->getIdproduto2()->getId(),
                1
            );
        }
        return $grafo;
    }
}
