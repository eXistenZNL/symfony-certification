<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    /**
     * @Route("/task/new", name="task_new")
     */
    public function postAction(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('doctrine')->getManager()->persist($task);

            return $this->redirectToRoute('task_show');
        }

        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/task/show/{id}", name="task_show")
     */
    public function showAction()
    {
        return $this->render('default/task.html.twig');
    }
}
