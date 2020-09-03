<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController {
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder) {
        $user = new User();
        $user->setDateCreated(new \DateTime());

        $registerForm = $this->createForm(RegisterType::class, $user);

        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            // Hacher mot de passe
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashed);


            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("success", "User created");

            return $this->redirectToRoute("user_list");
        }

        return $this->render('user/register.html.twig', [
            'registerForm' => $registerForm->createView(),
        ]);
    }

    /**
     * @Route("/user/list", name="user_list")
     * @return Response
     */
    public function list() {
        $userRepo = $this->getDoctrine()->getRepository(User::class);

        $listUsers = $userRepo->findBy([], ["username" => "ASC"], 30, 0);

        return $this->render('user/list.html.twig', [
            'listUsers' => $listUsers,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login() {

        return $this->render('user/login.html.twig', []);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        $this->addFlash("success", "User logged out");
    }
}
