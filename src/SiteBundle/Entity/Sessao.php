<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sessao
 *
 * @ORM\Table(name="sessao", uniqueConstraints={@ORM\UniqueConstraint(name="cookieKey_unique", columns={"cookieKey"})}, indexes={@ORM\Index(name="fk_sessao_fos_user1_idx", columns={"idUsuario"})})
 * @ORM\Entity
 */
class Sessao
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
     * @ORM\Column(name="cookieKey", type="string", length=25, nullable=false)
     */
    private $cookiekey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCadastro", type="datetime", nullable=false)
     */
    private $datacadastro;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip;

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

    function getCookiekey() {
        return $this->cookiekey;
    }

    function getDatacadastro() {
        return $this->datacadastro;
    }

    function getIp() {
        return $this->ip;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCookiekey($cookiekey) {
        $this->cookiekey = $cookiekey;
    }

    function setDatacadastro(\DateTime $datacadastro) {
        $this->datacadastro = $datacadastro;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setIdusuario(\FosUser $idusuario) {
        $this->idusuario = $idusuario;
    }


}

