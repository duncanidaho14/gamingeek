<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\JeuxvideoRepository;
use App\Repository\PlateformeRepository;
use App\Repository\NationaliteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(SerializerInterface $serializer, JeuxvideoRepository $jeuxvideoRepo, NationaliteRepository $nationaliteRepo,
        AuteurRepository $auteurRepo, PlateformeRepository $plateformeRepo, CategorieRepository $categorieRepo): Response
    {

        $regions = \file_get_contents('https://geo.api.gouv.fr/regions');
        $regionsTab = $serializer->decode($regions, 'json');
        $regionsObj = $serializer->denormalize($regionsTab, 'App\Entity\Region[]'); // [] crochet important pour signaler que c'est un tableau
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'regionsTab' => $regionsTab,
            'regionsObj' => $regionsObj,
            'nationaliterepo' => $nationaliteRepo->findAll(),
            'auteurrepo' => $auteurRepo->findAll(),
            'categorierepo' => $categorieRepo->findAll(),
            'plateformerepo' => $plateformeRepo->findAll(),
            'jeuxvideorepo' => $jeuxvideoRepo->findAll(),
        ]);
    }
}
