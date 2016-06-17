<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto", indexes={@ORM\Index(name="fk_produto_produto_marca_idx", columns={"idMarca"}), @ORM\Index(name="fk_produto_produto_tamanho1_idx", columns={"idTamanho"}), @ORM\Index(name="fk_produto_produto_categoria1_idx", columns={"idCategoria"}), @ORM\Index(name="fk_produto_produto_genero1_idx", columns={"idGenero"}), @ORM\Index(name="fk_produto_produto_cor1_idx", columns={"idCor"})})
 * @ORM\Entity
 */
class Produto
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
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="desconto", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $desconto;

    /**
     * @var \ProdutoMarca
     *
     * @ORM\ManyToOne(targetEntity="ProdutoMarca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMarca", referencedColumnName="id")
     * })
     */
    private $idmarca;

    /**
     * @var \ProdutoTamanho
     *
     * @ORM\ManyToOne(targetEntity="ProdutoTamanho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTamanho", referencedColumnName="id")
     * })
     */
    private $idtamanho;

    /**
     * @var \ProdutoCategoria
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;

    /**
     * @var \ProdutoGenero
     *
     * @ORM\ManyToOne(targetEntity="ProdutoGenero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGenero", referencedColumnName="id")
     * })
     */
    private $idgenero;

    /**
     * @var \ProdutoCor
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCor", referencedColumnName="id")
     * })
     */
    private $idcor;
    
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValor() {
        return $this->valor;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function getIdmarca() {
        return $this->idmarca;
    }

    function getIdtamanho() {
        return $this->idtamanho;
    }

    function getIdcategoria() {
        return $this->idcategoria;
    }

    function getIdgenero() {
        return $this->idgenero;
    }

    function getIdcor() {
        return $this->idcor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    function setIdmarca(\ProdutoMarca $idmarca) {
        $this->idmarca = $idmarca;
    }

    function setIdtamanho(\ProdutoTamanho $idtamanho) {
        $this->idtamanho = $idtamanho;
    }

    function setIdcategoria(\ProdutoCategoria $idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    function setIdgenero(\ProdutoGenero $idgenero) {
        $this->idgenero = $idgenero;
    }

    function setIdcor(\ProdutoCor $idcor) {
        $this->idcor = $idcor;
    }



}

