<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PedidoController extends Controller
{
    /**
     * @Route("/api/pedido")
     * @Method("POST")
	 * @ApiDoc(
     *  resource=true,
     *  description="Cadastra um novo pedido",
     *  filters={
     *    {"name"="produtos", "dataType"="[[id : 10, qtd: 2]]"},
     *  }
     * )
     */
    public function newAction(Request $request)
    {
        //Verifica usuário logado.
        if(!$request->getSession()->get('session_status', false)){
            return new JsonResponse(['status' => false, 'message' => 'Método não permitido para usuário não logado.'], 401);
        }
        $produtos = $request->request->get('produtos');

        if(!count($produtos)){
            return new JsonResponse(['status' => false, 'message' => 'Nenhum id de produto informado']);
        }

        $pedido = new \SiteBundle\Entity\Pedido();
        $pedido
            ->setDataCadastro(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($pedido);
        $em->flush();

        $valorTotal = 0;
        foreach ($produtos as $produtoParam) {
            $produto = $em->getRepository('SiteBundle:Produto')->find($produtoParam['id']);

            $pedidoProduto = new \SiteBundle\Entity\PedidoProduto();
            $pedidoProduto
                ->setIdProduto($produto)
                ->setIdPedido($pedido)
                ->setDesconto(0)
                ->setQtd($produtoParam['qtd'])
                ->setValorUnitario($produto->getValor())
                ->setValorTotal($produtoParam['qtd'] * $produto->getValor());

            $em->persist($pedidoProduto);
            $em->flush();

            $valorTotal += $pedidoProduto->getValorTotal();
        }

        $pedido->setValorTotal($valorTotal);
        $em->persist($pedido);
        $em->flush();

        return new JsonResponse(['status' => true, 'message' => "Pedido {$pedido->getId()} cadastrado."]);
    }
}