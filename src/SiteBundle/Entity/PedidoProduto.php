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
     * @ORM\GeneratedValue(strategy="AUTO")
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
    
    function getId() {
        return $this->id;
    }

    function getQtd() {
        return $this->qtd;
    }

    function getValorUnitario() {
        return $this->valorunitario;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function getValorTotal() {
        return $this->valortotal;
    }

    function getIdPedido() {
        return $this->idpedido;
    }

    function getIdProduto() {
        return $this->idproduto;
    }

    function setId($id) {
        $this->id = $id;

        return $this;
    }

    function setQtd($qtd) {
        $this->qtd = $qtd;

        return $this;
    }

    function setValorUnitario($valorunitario) {
        $this->valorunitario = $valorunitario;

        return $this;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;

        return $this;
    }

    function setValorTotal($valortotal) {
        $this->valortotal = $valortotal;

        return $this;
    }

    function setIdPedido(\SiteBundle\Entity\Pedido $idpedido) {
        $this->idpedido = $idpedido;

        return $this;
    }

    function setIdProduto(\SiteBundle\Entity\Produto $idproduto) {
        $this->idproduto = $idproduto;

        return $this;
    }
}