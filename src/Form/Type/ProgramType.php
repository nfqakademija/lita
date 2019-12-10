<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ProgramType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Programa', ChoiceType::class, [
                'choices' => [
                    'Front-End programuotojas'  => 'Front-End',
                    'Back-End programuotojas'   => 'Back-End',
                    'Testuotojas' => 'Testavimas',
                ],
            ])
            ->add('Miestas', ChoiceType::class, [
                'choices' => [
                    'Vilnius'  => 'Vilnius',
                    'Kaunas'   => 'Kaunas',
                    'Klaipeda' => 'Klaipeda',
                ],
            ])
            ->add('Kaina', ChoiceType::class, [
                'choices' => [
                    'Nemokama'  => 'Nemokama',
                    'Pigiausios viršuje'   => 'Pigiausios viršuje',
                    'Brangiausios viršuje' => 'Brangiausios viršuje',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label'  =>   'Filtruoti'
            ])
        ;
    }
}
