<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Salle;
use App\Entity\Adresse;
use App\Entity\Categorie;
use App\Repository\SalleRepository;
use App\Repository\CategorieRepository;




class SalleController extends AbstractController
{

    /**
     * @Rest\Get("/salles")
     */
    public function getSalles(SalleRepository $salleRepository)
    {
        $salles = $salleRepository->findAll();
        $sallesJson = [];

        foreach($salles as $salle){

            $SalleObject = [
                'id' => $salle->getId(),
                'nomSalle' => $salle->getNom(),
                'km' => $salle->getKm(),
                'description' => $salle->getDescription(),
                'tarif' => $salle->getTarif(),
                'adresse' => $salle->getAdresse()->getAdresse(),
                'codePostal' => $salle->getAdresse()->getCodepostal(),
                'ville' => $salle->getAdresse()->getVille()


            ];
            $sallesJson[]= $SalleObject;
            }

        return $this->json( $sallesJson );
    
    }


   /**
     * @Rest\Get("/salles/{id}")
     */
    public function sallesId(SalleRepository $salleRepository, $id)
    {

       $sallesCategorie = $salleRepository->findBy(['categorie' => $id]);
        $sallesJson = [];

        foreach($sallesCategorie as $salle){

            $SalleObject = [
                'nomSalle' => $salle->getNom(),
                'km' => $salle->getKm(),
                'description' => $salle->getDescription(),
                'tarif' => $salle->getTarif(),
                'adresse' => $salle->getAdresse()->getAdresse(),
                'codePostal' => $salle->getAdresse()->getCodepostal(),
                'ville' => $salle->getAdresse()->getVille()


            ];
            $sallesJson[]= $SalleObject;
            }



        return $this->json($sallesJson);
    }

     /**
     * @Rest\Get("/categories")
     */
    public function getCategories(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();
        $categoriesJson = [];


        foreach( $categories as  $categorie){

            $CategorieObject = [
                "nom" => $categorie->getNom(),
                "id" => $categorie->getId()
            ];
            $categoriesJson[] = $CategorieObject;
        }

        return $this->json( $categoriesJson);

    }


     /**
     * @Rest\Post("/salles")
     * @param Request $request
     */

    public function postSalles(Request $request,CategorieRepository $categorieRepository)
    {
        $body = json_decode($request->getContent(), true);
        $entityManager = $this->getDoctrine()->getManager();
        $salle = new Salle();
        $adresse =  new Adresse();
        $categorie = $categorieRepository->findOneBy(["nom" => $body["categorie"]]);



        $salle->setNom($body["nomSalle"]);
        $salle->setKm((int)$body["km"]);
        $salle->setDescription($body["description"]);
        $salle->setTarif( (int) $body["tarif"]);
        $salle->setPictures($body["pictures"]);
        $salle->setCategorie($categorie);

        


        $adresse->setAdresse($body["adresse"]);
        $adresse->setCodepostal((int)$body["codePostal"]);
        $adresse->setville($body["ville"]);
        $salle->setAdresse($adresse);
        $adresse->setSalle($salle);


        $entityManager->persist($salle);
        $entityManager->persist($adresse);
        $entityManager->flush();


        return $this->json(['alert' => 'new Salle added successfully']);

    }
}
