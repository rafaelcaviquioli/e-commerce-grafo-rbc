<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use SiteBundle\Entity\ProdutoMarcaType;
use SiteBundle\Entity\ProdutoTamanhoType;
use SiteBundle\Entity\ProdutoCategoriaType;
use SiteBundle\Entity\ProdutoGeneroType;
use SiteBundle\Entity\ProdutoCorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProdutoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao')
            ->add('valor')
            ->add('desconto')

            ->add('idmarca', CollectionType::class, array(
                'entry_type' => ProdutoMarcaType::class,
            ))

            ->add('idtamanho', CollectionType::class, array(
                'entry_type' => ProdutoTamanhoType::class
            ))

            ->add('idcategoria', CollectionType::class, array(
                'entry_type' => ProdutoCategoriaType::class
            ))

            ->add('idgenero', CollectionType::class, array(
                'entry_type' => ProdutoGeneroType::class
            ))

            ->add('idcor', CollectionType::class, array(
                'entry_type' => ProdutoCorType::class
            ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiteBundle\Entity\Produto'
        ));
    }
}
