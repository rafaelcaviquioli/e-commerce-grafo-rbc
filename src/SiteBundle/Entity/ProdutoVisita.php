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
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="dataCadastro", type="datetime", nullable=false)
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

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="id")
     * })
     */
    private $idusuario;

    function getId() {
        return $this->id;
    }

    function getDatacadastro() {
        return $this->datacadastro;
    }

    function getIdproduto() {
        return $this->idproduto;
    }

    function getIdsessao() {
        return $this->idsessao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;

        return $this;
    }

    function setIdproduto($idproduto) {
        $this->idproduto = $idproduto;

        return $this;
    }

    function setIdsessao($idsessao) {
        $this->idsessao = $idsessao;

        return $this;
    }
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
        return $this;
    }


}

