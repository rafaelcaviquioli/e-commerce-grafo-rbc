<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UsuarioController extends Controller
{
    /**
     * @Route("/api/usuario")
     * @Method("POST")
	 * @ApiDoc(
     *  resource=true,
     *  description="Cadastra um novo usuário",
     *  requirements={
     *    {"name"="nome", "requirement"="true", "dataType"="string"},
     *    {"name"="email", "requirement"="true", "dataType"="string"},
     *    {"name"="senha", "requirement"="true", "dataType"="string"},
     *    {"name"="confirmarSenha", "requirement"="true", "dataType"="string"},
     *  },
     * )
     */
    public function newAction(Request $request)
    {
        $nome = $request->request->get('nome');
        $email = $request->request->get('email');
        $senha = $request->request->get('senha');
        $confirmarSenha = $request->request->get('confirmarSenha');

        $errosValidacao = [];

        if(empty($nome)){
            $errosValidacao[] = "Nome do usuário não informado";
        }
        
        if(empty($email)){
            $errosValidacao[] = "E-mail do usuário não informado";
        }

        if(empty($senha)){
            $errosValidacao[] = "Senha do usuário não informada";
        }

        if($senha != $confirmarSenha){
            $errosValidacao[] = "Confirmação de senha do usuário é válida.";
        }

        if(count($errosValidacao)){
            return new JsonResponse(['status' => false, 'message' => implode('\n', $errosValidacao)]);
        }

        $usuario = new \SiteBundle\Entity\Usuario();
        $usuario
            ->setNome($nome)
            ->setEmail($email)
            ->setSenha(md5($senha));

        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();

        return new JsonResponse(['status' => true, 'message' => "Usuário {$usuario->getId()} cadastrado com sucesso."]);
    }
}