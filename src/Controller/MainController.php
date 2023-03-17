<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/pokedex', name: 'main_pokedex')]
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


    //redirect

    #[Route('/pokemon/capture/{id}', name: 'main_capture')]
    public function capturer(int $id, PokemonRepository $pokemonRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pokemon = $pokemonRepository->find($id);
        $pokemon->setEstCapture(!$pokemon->isEstCapture());
        $entityManager->persist($pokemon);
        $entityManager->flush();


        return $this->redirectToRoute('main_pokedex', [

        ]);
    }
}
