<?php

namespace App\Form\Type;

use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('review_stars', IntegerType::class)
            ->add('review_comment', TextType::class)
            ->add('review_data', DateTimeType::class);
//            ->add('consumer_id')
//            ->add('program', EntityType::class, [
//                'class' => Program::class,
//                'choice_label' => 'id',
//            ]);
    }
}
