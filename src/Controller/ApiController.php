<?php

namespace App\Controller;

use App\Entity\Sites;
use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/site/{uuid}", name="api")
     */
    public function index(ManagerRegistry $doctrine, $uuid): Response
    {
        $entityManager = $doctrine->getManager();
        $sitesRepository = $entityManager->getRepository(Sites::class);
        $site = $sitesRepository->findOneBy(['uuid' => $uuid]);
        return $this->json($site->toArray());
    }

    /**
     * @Route("/api/users/{uuid}", name="getUsers", methods={"GET"})
     */
    public function getUsers(ManagerRegistry $doctrine, $uuid): Response
    {
        $entityManager = $doctrine->getManager();
        $sitesRepository = $entityManager->getRepository(Sites::class);
        $site = $sitesRepository->findOneBy(['uuid' => $uuid]);

        $users = $site->getUsers();
        $result = [];
        foreach ($users as $userItem){
            $result[] = $userItem->toArray();
        }

        return $this->json($result);
    }

    /**
     * @Route("/api/user/{uuid}", name="getUser", methods={"GET"})
     */
    public function getUserItem(ManagerRegistry $doctrine, $uuid): Response
    {
        $entityManager = $doctrine->getManager();
        $usersRepository = $entityManager->getRepository(Users::class);
        $user = $usersRepository->findOneBy(['uuid' => $uuid]);
        return $this->json($user->toArray());
    }

    /**
     * @Route("/api/user", name="createUser", methods={"POST"})
     */
    public function createUser(ManagerRegistry $doctrine, Request $request): Response
    {
        $monthUid = $request->request->get('month_uid');
        $appeal = $request->request->get('appeal');
        $name = $request->request->get('name');
        $description = $request->request->get('description');

        $entityManager = $doctrine->getManager();
        $sitesRepository = $entityManager->getRepository(Sites::class);
        $site = $sitesRepository->findOneBy(['uuid' => $monthUid]);

        $user = new Users();
        $user->setUuid(Uuid::v4());
        $user->setAppeal($appeal);
        $user->setName($name);
        $user->setDescription($description);
        $user->setSite($site);

        $entityManager->persist($user);
        $entityManager->flush();


        return $this->json($user->toArray());
    }

    /**
     * @Route("/api/user/{uuid}", name="updateUser", methods={"PUT"})
     */
    public function updateUser(ManagerRegistry $doctrine, Request $request, $uuid): Response
    {
        $isVisit = $request->request->get('is_visit');
        $entityManager = $doctrine->getManager();
        $usersRepository = $entityManager->getRepository(Users::class);
        $user = $usersRepository->findOneBy(['uuid' => $uuid]);

        $user->setIsVisit($isVisit === 'true');
        $entityManager->flush();

        return $this->json($user->toArray());
    }

    /**
     * @Route("/api/user/{uuid}", name="deleteUser", methods={"DELETE"})
     */
    public function deleteUser(ManagerRegistry $doctrine, $uuid): Response
    {
        $entityManager = $doctrine->getManager();
        $usersRepository = $entityManager->getRepository(Users::class);
        $user = $usersRepository->findOneBy(['uuid' => $uuid]);

        $entityManager->remove($user);
        $entityManager->flush();

        $users = $usersRepository->findAll();
        $result = [];
        foreach ($users as $userItem){
            $result[] = $userItem->toArray();
        }

        return $this->json($result);
    }
}
