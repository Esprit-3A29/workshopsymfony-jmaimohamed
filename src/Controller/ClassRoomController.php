<?php

namespace App\Controller;
use App\Entity\ClassRoom;
use App\Form\ClassRoomtype;
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
    return $this->render("classroom/list.html.twig",array("tab_class"=>$classroom));

}
#[route('/addform',name:'add_classroom')]
public function addClassroom(ManagerRegistry $doctrine,Request $request)
{
    $classroom =new ClassRoom;
    $form =$this->createForm(ClassRoomType::class,$classroom);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $em=$doctrine->getManager($request);
        $em->persist($classroom);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
    }
}
#[route('/upadateform',name:'update_classroom')]
public function updateClassroom($id,ClassRoomRepository $Repository ,ManagerRegistry $doctrine,Request $request)
{
    $classroom=$Repository->find($id);
    $form =$this->createForm(ClassRoomType::class,$classroom);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $em=$doctrine->getManager($request);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
    }
    return $this->render("classroom/list.html.twig",array("tab_class"=>$classroom));
}
#[route('/deleteform/{id}',name:'remove')]
public function deleteClassroom($id,ClassRoomRepository $Repository ,ManagerRegistry $doctrine,Request $request)
{
    $classroom=$Repository->find($id);
    
        $em=$doctrine->getManager($request);
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
}

}