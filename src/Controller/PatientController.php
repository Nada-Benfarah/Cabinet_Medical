<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\PatientForm;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{

    #[Route('/patient1', name: 'app_Patient')]
    public function index(): Response
    {
        return $this->render('patient1/index1.html.twig', [
            'controller_name' => 'PatientController',
        ]);

    }
    #[Route('/patient', name: 'patient')]
    public function listPatient(EntityManagerInterface $em): Response

    {

        $Patients = $em ->getRepository("App\Entity\User") -> findAll();
        return $this->render('patient/listPatient.html.twig', [
            'listPatient' => $Patients,
        ]);
    }



    #[Route('/addPatient', name: 'add_patient')]
    public function addPatient(Request $request, EntityManagerInterface $em)

    {
        $patient = new User();
        $form = $this->createForm(PatientForm::class,$patient);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->persist($patient);
            $em->flush();
            return $this->redirectToRoute("patient");
        }
        return $this->render('patient/addPatient.html.twig',
            ["formV"=>$form->createView()]);
    }

    #[Route('/patient/{id}', name: 'patientDelete')]
    public function delete(EntityManagerInterface $em, PatientRepository$vr, $id): Response

    {

        $patient= $vr-> find($id);
        $em->remove($patient);
        $em->flush();
        return $this->redirectToRoute('patient');

    }



    #[Route('/updatePatient/{id}', name: 'patientUpdate')]
    public function updatePatient(Request $request, EntityManagerInterface $em, PatientRepository$vr, $id)

    {
        $patient= $vr-> find($id);
        $editform = $this->createForm(PatientForm::class,$patient);
        $editform->handleRequest($request);
        if($editform->isSubmitted() and $editform->isValid()){
            $em->persist($patient);
            $em->flush();
            return $this->redirectToRoute("patient");
        }
        return $this->render('patient/updatePatient.html.twig.twig',
            ["editFormPatient"=>$editform->createView()]);
    }


}
