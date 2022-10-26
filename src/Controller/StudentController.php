<?php

namespace App\Controller;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/etudiant', name: 'etudiants')]

    public function etudiants()
    {
    return new Response("Bonjour mes etudiants !");
    }
    #[route('/listeStudent',name:'list_student')]
    public function listStudent(StudentRepository $repository):Response
    {$List=$repository->findAll();
        $topStudents= $repository->topStudent();
    return $this->render('student/listeStudent.html.twig',array("tab_student"=>$List,'topStudents'=>$topStudents));
    }
    
    #[route('/add1',name:'add_student')]
public function addStudent(ManagerRegistry $doctrine,Request $request, StudentRepository $repository )
{
    $student =new student;
    $form =$this->createForm(StudentType::class,$student);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
      $repository->save($student,True)  ;
      return $this->redirectToRoute("list_student");
 
    }
    return $this->renderForm("student/add.html.twig",array("formStudent"=>$form));
}
  
}