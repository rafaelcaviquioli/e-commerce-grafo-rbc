<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class SessaoController extends Controller
{
    /**
     * @Route("/api/sessao/{token}")
     * @Method("GET")
	 * @ApiDoc(
     *  resource=true,
     *  description="Retorna o status da sessao",
     *  filters={
     *  }
     * )
     */
    public function indexAction($token)
    {
        $usuarios = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Usuario')->findBy(['token' => $token]);

         return new JsonResponse(['status' => (count($usuarios) == 1 ? true : false)]);
    }


    /**
     * @Route("/api/sessao/login/{email}/{senha}")
     * @Method("GET")
     * @ApiDoc(
     *  resource=true,
     *  description="Efetua login de usuário",
     *  requirements={
     *    {"name"="email", "requirement"="true", "dataType"="string"},
     *    {"name"="senha", "requirement"="true", "dataType"="string"},
     *  }
     * )
     */
    public function loginAction($email, $senha)
    {
        $usuarios = $this->getDoctrine()->getManager()->getRepository('SiteBundle:Usuario')->findBy(['email' => $email, 'senha' => md5($senha)]);

        if(count($usuarios) == 1){

            return new JsonResponse(['status' => true, 'message' => 'Login efetuado com sucesso.', 'usuario' => $usuarios[0]]);
        }
        
        return new JsonResponse(['status' => false, 'message' => 'Login ou senha incorretos']);
    }
}
