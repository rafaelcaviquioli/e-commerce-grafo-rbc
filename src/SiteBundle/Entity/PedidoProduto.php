<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoProduto
 *
 * @ORM\Table(name="pedido_produto", indexes={@ORM\Index(name="fk_pedido_produto_pedido1_idx", columns={"idPedido"}), @ORM\Index(name="fk_pedido_produto_produto1_idx", columns={"idProduto"})})
 * @ORM\Entity
 */
class PedidoProduto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="qtd", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $qtd;

    /**
     * @var string
     *
     * @ORM\Column(name="valorUnitario", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valorunitario;

    /**
     * @var string
     *
     * @ORM\Column(name="desconto", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $desconto;

    /**
     * @var string
     *
     * @ORM\Column(name="valorTotal", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valortotal;

    /**
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPedido", referencedColumnName="id")
     * })
     */
    private $idpedido;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduto", referencedColumnName="id")
     * })
     */
    private $idproduto;


}

