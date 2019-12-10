<?php
namespace App\Form\Type;

use App\Entity\City;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('Programa', EntityType::class, [
                'class' => Program::class,
                'choice_label' => function (Program $program) {
                    return sprintf($program->getProgramName());
                }
            ])
            ->add('Miestas', EntityType::class, [
                'class' => City::class,
                'choice_label' => function (City $city) {
                    return sprintf($city->getCity());
                }
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
