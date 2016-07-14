<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoGrafo
 *
 * @ORM\Table(name="produto_grafo", indexes={@ORM\Index(name="idProduto2", columns={"idProduto2"}), @ORM\Index(name="idProduto1", columns={"idProduto1"})})
 * @ORM\Entity
 */
class ProdutoGrafo
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
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduto1", referencedColumnName="id")
     * })
     */
    private $idproduto1;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduto2", referencedColumnName="id")
     * })
     */
    private $idproduto2;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProdutoGrafo
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Produto
     */
    public function getIdproduto1()
    {
        return $this->idproduto1;
    }

    /**
     * @param \Produto $idproduto1
     * @return ProdutoGrafo
     */
    public function setIdproduto1($idproduto1)
    {
        $this->idproduto1 = $idproduto1;
        return $this;
    }

    /**
     * @return \Produto
     */
    public function getIdproduto2()
    {
        return $this->idproduto2;
    }

    /**
     * @param \Produto $idproduto2
     * @return ProdutoGrafo
     */
    public function setIdproduto2($idproduto2)
    {
        $this->idproduto2 = $idproduto2;
        return $this;
    }


}

