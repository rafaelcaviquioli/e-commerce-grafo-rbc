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


}

