<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoVisita
 *
 * @ORM\Table(name="produto_visita", indexes={@ORM\Index(name="fk_produto_visita_produto1_idx", columns={"idProduto"}), @ORM\Index(name="fk_produto_visita_sessao1_idx", columns={"idSessao"})})
 * @ORM\Entity
 */
class ProdutoVisita
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
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduto", referencedColumnName="id")
     * })
     */
    private $idproduto;

    /**
     * @var \Sessao
     *
     * @ORM\ManyToOne(targetEntity="Sessao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSessao", referencedColumnName="id")
     * })
     */
    private $idsessao;


}

