<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_accueil')]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig', [

        ]);
    }

    #[Route('/pokemon', name: 'main_pokemon')]
    public function pokemon(PokemonRepository $pokemonRepository): Response
    {

        $pokedex = $pokemonRepository->findAll();
        dump($pokedex);



        return $this->render('main/pokemon.html.twig', [
            'pokedex' => $pokedex

        ]);
    }

}
