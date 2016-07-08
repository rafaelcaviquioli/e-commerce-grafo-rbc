<?php

namespace AdminBundle\Service;

use \Symfony\Component\Form\Form;

class FormError
{
    /*
     * @todo Recebe o formulário processado e retorna uma array<string> com as mensagens de erro de validação
     */
    static function toFlashBag(Form $form)
    {
        $errors = [];

        if($form instanceof Form) {
            foreach ($form as $fieldName => $formField) {
                if (!count($formField->getErrors())) {
                    continue;
                }
                foreach ($formField->getErrors() as $erro) {
                    $errors[] = "[$fieldName] " . $erro->getMessage();
                }
            }
        }
        return $errors;
    }
}