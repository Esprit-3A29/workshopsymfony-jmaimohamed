<?php

namespace App\Controller;
use App\Entity\ClassRoom;
use App\Form\ClassRoomType;
use App\Repository\ClassRoomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClassRoomController extends AbstractController
{
#[route('/classroom',name:'app_classroom')]
public function index():Response
{
    return $this->render('classroom/index.html.twig',['controller_name'=>'ClassRoomController',]);

}

#[route('/listclassroom',name:'list_classroom')]
public function listClassroom(ClassRoomRepository $repository)
{
    $classroom=$repository->findAll();
    $order = $repository->order();
    $topStudents= $repository->topStudent();
    return $this->render("classroom/list.html.twig",array("tab_class"=>$classroom,"orderbyy"=>$order,'topStudents'=>$topStudents));

}
#[route('/addform',name:'add_classroom')]
public function addClassroom(ManagerRegistry $doctrine,Request $request)
{
    $classroom =new ClassRoom;
    $form =$this->createForm(ClassRoomType::class,$classroom);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $em=$doctrine->getManager();
        $em->persist($classroom);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
    }
    return $this->renderForm("classroom/add.html.twig",array("formClassRoom"=>$form));
}
#[route('/upadateform/{id}',name:'update_classroom')]
public function updateClassroom($id,ClassRoomRepository $Repository ,ManagerRegistry $doctrine,Request $request)
{
    $classroom=$Repository->find($id);
    $form =$this->createForm(ClassRoomType::class,$classroom);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $em=$doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute("list_classroom");
    }
    return $this->renderForm("classroom/update.html.twig",array("formClassRoom"=>$form));
}

#[route('/deleteform/{id}',name:'remove')]
public function deleteClassroom($id,ClassRoomRepository $Repository ,ManagerRegistry $doctrine,Request $request)
{
         $classroom=$Repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
}

}