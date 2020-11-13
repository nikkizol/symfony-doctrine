<?php

namespace App\Form;
use App\Form\AddressType;
use App\Entity\Address;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Teacher;
use App\Repository\TeacherRepository;
use App\Repository\AddressRepository;


class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('email')
            ->add('teacher', EntityType::class, [
                'class' => Teacher::class,
                'query_builder' => function (TeacherRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.firstName', 'ASC');
                },
                'choice_label' => 'firstName',
            ])
            ->add('address', AddressType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
