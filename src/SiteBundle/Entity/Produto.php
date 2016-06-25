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
     * @ORM\GeneratedValue(strategy="AUTO")
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

    /**
     * @return \ProdutoCor
     */
    public function getIdcor()
    {
        return $this->idcor;
    }

    /**
     * @param \ProdutoCor $idcor
     * @return Produto
     */
    public function setIdcor($idcor)
    {
        $this->idcor = $idcor;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Produto
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return Produto
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     * @return Produto
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return string
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * @param string $desconto
     * @return Produto
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
        return $this;
    }

    /**
     * @return \ProdutoMarca
     */
    public function getIdmarca()
    {
        return $this->idmarca;
    }

    /**
     * @param \ProdutoMarca $idmarca
     * @return Produto
     */
    public function setIdmarca($idmarca)
    {
        $this->idmarca = $idmarca;
        return $this;
    }

    /**
     * @return \ProdutoTamanho
     */
    public function getIdtamanho()
    {
        return $this->idtamanho;
    }

    /**
     * @param \ProdutoTamanho $idtamanho
     * @return Produto
     */
    public function setIdtamanho($idtamanho)
    {
        $this->idtamanho = $idtamanho;
        return $this;
    }

    /**
     * @return \ProdutoCategoria
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * @param \ProdutoCategoria $idcategoria
     * @return Produto
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
        return $this;
    }

    /**
     * @return \ProdutoGenero
     */
    public function getIdgenero()
    {
        return $this->idgenero;
    }

    /**
     * @param \ProdutoGenero $idgenero
     * @return Produto
     */
    public function setIdgenero($idgenero)
    {
        $this->idgenero = $idgenero;
        return $this;
    }



}

