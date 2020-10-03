<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Adresse;





class UserController extends AbstractController
{
    /**
     * @Rest\Get("/users")
     */
    public function getUsers(Request $request,UserRepository $userRepository)
    {
       
        $users= $userRepository->findAll();
        $usersJson = [];
      

        foreach($users as $user){

            $userObject = [
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'dateNaissance' => $user->getDateNaissance(),
                'telephone' => $user->getTelephone(),
                'age' => $user->getAge(),
                'dateNaissance' => $user->getDateNaissance(),
                'adresse' => $user->getAdresse()->getAdresse(),
                'codePostal' => $user->getAdresse()->getCodepostal(),
                'ville' => $user->getAdresse()->getVille()


            ];
            $usersJson[]= $userObject;
            }

        return $this->json($usersJson);
    }





   /**
     * @Rest\Post("/users")
     * @param Request $request
     */
    
    public function postUsers(Request $request,ValidatorInterface $validator,UserPasswordEncoderInterface $encoder)
    {
    
        $body = json_decode($request->getContent(), true);
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $adresse =  new Adresse();

       

        $user->setNom($body["nom"]);
        $user->setprenom($body["prenom"]);
        $user->setEmail($body["email"]);
        $user->setPassword($body["password"]);
        $user->setDateNaissance(new \DateTime($body["dateNaissance"]));
        $user->setTelephone((int) $body["telephone"]);
        $user->setAge( (int)$body["age"]);


        $errors = $validator->validate($user);
        $errorsUser = [];

       
        foreach($errors as $error){
            $key = $error->getPropertyPath();
            $message = $error->getMessage();

            if(!array_key_exists($key , $errorsUser)) {
                $errorsUser[$key] = [];           
              }  

              switch ($key) {
                case "email":
                    array_push($errorsUser[$key],$message);
                break;
                case "nom":
                    array_push($errorsUser[$key],$message);
                break;
                case "prenom":
                    array_push($errorsUser[$key],$message);
                break;
                case "age":
                    array_push($errorsUser[$key],$message);
                break;
                case "password":
                    array_push($errorsUser[$key],$message);
                break;
                case "telephone":
                    array_push($errorsUser[$key],$message);
                    break;
            }

        }


        if (count( $errorsUser ) > 0) {
            return $this->json(['errorsUser' => $errorsUser]);
    
        }
  

        $adresse->setAdresse($body["adresse"]);
        $adresse->setCodepostal((int)$body["codePostal"]);
        $adresse->setville($body["ville"]);
        $user->setAdresse($adresse);

        //Encode a Password
        $encoded = $encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($encoded);


        $entityManager->persist($adresse);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json("user est cree dans le base de donnes");

    }


}
