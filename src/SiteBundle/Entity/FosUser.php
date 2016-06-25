<?php

namespace SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FosUser
 *
 * @ORM\Table(name="fos_user2", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_957A647992FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_957A6479A0D96FBF", columns={"email_canonical"})})
 * @ORM\Entity
 */
class FosUser
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="username_canonical", type="string", length=255, nullable=false)
     */
    private $usernameCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_canonical", type="string", length=255, nullable=false)
     */
    private $emailCanonical;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expired", type="boolean", nullable=false)
     */
    private $expired;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=false)
     */
    private $roles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="credentials_expired", type="boolean", nullable=false)
     */
    private $credentialsExpired;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="credentials_expire_at", type="datetime", nullable=true)
     */
    private $credentialsExpireAt;
    
    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getUsernameCanonical() {
        return $this->usernameCanonical;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmailCanonical() {
        return $this->emailCanonical;
    }

    function getEnabled() {
        return $this->enabled;
    }

    function getSalt() {
        return $this->salt;
    }

    function getPassword() {
        return $this->password;
    }

    function getLastLogin() {
        return $this->lastLogin;
    }

    function getLocked() {
        return $this->locked;
    }

    function getExpired() {
        return $this->expired;
    }

    function getExpiresAt() {
        return $this->expiresAt;
    }

    function getConfirmationToken() {
        return $this->confirmationToken;
    }

    function getPasswordRequestedAt() {
        return $this->passwordRequestedAt;
    }

    function getRoles() {
        return $this->roles;
    }

    function getCredentialsExpired() {
        return $this->credentialsExpired;
    }

    function getCredentialsExpireAt() {
        return $this->credentialsExpireAt;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setUsernameCanonical($usernameCanonical) {
        $this->usernameCanonical = $usernameCanonical;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmailCanonical($emailCanonical) {
        $this->emailCanonical = $emailCanonical;
    }

    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    function setSalt($salt) {
        $this->salt = $salt;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setLastLogin(\DateTime $lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    function setLocked($locked) {
        $this->locked = $locked;
    }

    function setExpired($expired) {
        $this->expired = $expired;
    }

    function setExpiresAt(\DateTime $expiresAt) {
        $this->expiresAt = $expiresAt;
    }

    function setConfirmationToken($confirmationToken) {
        $this->confirmationToken = $confirmationToken;
    }

    function setPasswordRequestedAt(\DateTime $passwordRequestedAt) {
        $this->passwordRequestedAt = $passwordRequestedAt;
    }

    function setRoles($roles) {
        $this->roles = $roles;
    }

    function setCredentialsExpired($credentialsExpired) {
        $this->credentialsExpired = $credentialsExpired;
    }

    function setCredentialsExpireAt(\DateTime $credentialsExpireAt) {
        $this->credentialsExpireAt = $credentialsExpireAt;
    }



}

