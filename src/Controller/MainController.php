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

    #[Route('/pokemon', name: 'main_pokedex')]
    public function pokedex(PokemonRepository $pokemonRepository): Response
    {

        $pokedex = $pokemonRepository->findAll();
        dump($pokedex);

        return $this->render('main/pokedex.html.twig', [
            'pokedex' => $pokedex

        ]);
    }

    #[Route('/pokemon/{id}', name: 'main_pokemon')]
    public function pokemon(int $id, PokemonRepository $pokemonRepository): Response
    {

        $pokemon = $pokemonRepository->find($id);


        return $this->render('main/pokemon.html.twig', [
            'pokemon' => $pokemon

        ]);
    }







}
