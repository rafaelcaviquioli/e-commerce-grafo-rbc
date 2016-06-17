<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busca
 *
 * @ORM\Table(name="busca", indexes={@ORM\Index(name="fk_busca_sessao1_idx", columns={"idSessao"}), @ORM\Index(name="fk_busca_produto_marca1_idx", columns={"idMarca"}), @ORM\Index(name="fk_busca_produto_tamanho1_idx", columns={"idTamanho"}), @ORM\Index(name="fk_busca_produto_categoria1_idx", columns={"idCategoria"}), @ORM\Index(name="fk_busca_produto_genero1_idx", columns={"idGenero"}), @ORM\Index(name="fk_busca_produto_cor1_idx", columns={"idCor"})})
 * @ORM\Entity
 */
class Busca
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
     * @var integer
     *
     * @ORM\Column(name="dataCadastro", type="integer", nullable=false)
     */
    private $datacadastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="resultados", type="integer", nullable=false)
     */
    private $resultados;

    /**
     * @var \Sessao
     *
     * @ORM\ManyToOne(targetEntity="Sessao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSessao", referencedColumnName="id")
     * })
     */
    private $idsessao;

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

    function getDatacadastro() {
        return $this->datacadastro;
    }

    function getResultados() {
        return $this->resultados;
    }

    function getIdsessao() {
        return $this->idsessao;
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

    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }

    function setResultados($resultados) {
        $this->resultados = $resultados;
    }

    function setIdsessao(\Sessao $idsessao) {
        $this->idsessao = $idsessao;
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

