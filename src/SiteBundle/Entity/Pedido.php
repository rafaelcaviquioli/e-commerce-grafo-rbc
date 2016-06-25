<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", indexes={@ORM\Index(name="fk_pedido_fos_user1_idx", columns={"idUsuario"})})
 * @ORM\Entity
 */
class Pedido
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataCadastro", type="datetime", nullable=true)
     */
    private $datacadastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="situacao", type="integer", nullable=true)
     */
    private $situacao;

    /**
     * @var string
     *
     * @ORM\Column(name="valorTotal", type="string", length=45, nullable=true)
     */
    private $valortotal;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="User")
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

    function getSituacao() {
        return $this->situacao;
    }

    function getValortotal() {
        return $this->valortotal;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDatacadastro(\DateTime $datacadastro) {
        $this->datacadastro = $datacadastro;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setValortotal($valortotal) {
        $this->valortotal = $valortotal;
    }

    function setIdusuario(\FosUser $idusuario) {
        $this->idusuario = $idusuario;
    }



}

