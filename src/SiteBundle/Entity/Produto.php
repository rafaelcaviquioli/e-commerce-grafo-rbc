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
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    public $descricao;

     /**
     * @var string
     *
     * @ORM\Column(name="imagePath", type="string", length=255, nullable=false)
     */
    public $imagePath;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    public $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="desconto", type="decimal", precision=10, scale=2, nullable=true)
     */
    public $desconto;

    /**
     * @var \ProdutoMarca
     *
     * @ORM\ManyToOne(targetEntity="ProdutoMarca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMarca", referencedColumnName="id")
     * })
     */
    public $idmarca;

    /**
     * @var \ProdutoTamanho
     *
     * @ORM\ManyToOne(targetEntity="ProdutoTamanho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTamanho", referencedColumnName="id")
     * })
     */
    public $idtamanho;

    /**
     * @var \ProdutoCategoria
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    public $idcategoria;

    /**
     * @var \ProdutoGenero
     *
     * @ORM\ManyToOne(targetEntity="ProdutoGenero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGenero", referencedColumnName="id")
     * })
     */
    public $idgenero;

    /**
     * @var \ProdutoCor
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCor", referencedColumnName="id")
     * })
     */
    public $idcor;

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
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * @return Produto
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
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

    public function transformEntities(){
        $this->marca = [
            'id' => $this->idmarca->getId(),
            'descricao' => $this->idmarca->getDescricao()
        ];
        $this->tamanho = [
            'id' => $this->idtamanho->getId(),
            'descricao' => $this->idtamanho->getDescricao()
        ];
        $this->categoria = [
            'id' => $this->idcategoria->getId(),
            'descricao' => $this->idcategoria->getDescricao()
        ];
        $this->genero = [
            'id' => $this->idgenero->getId(),
            'descricao' => $this->idgenero->getDescricao()
        ];
        $this->cor = [
            'id' => $this->idcor->getId(),
            'descricao' => $this->idcor->getDescricao()
        ];
    }
    function __toString()
    {
        return $this->descricao;
    }
}

