<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function capturer(int $id, PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager): Response
    {

        $pokemon = $pokemonRepository->find($id);
        $pokemon->setEstCapture(!$pokemon->isEstCapture());
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return $this->redirectToRoute('main_pokedex', [
        ]);
    }

    #[Route('/pokemon/tri/{typeTrie}', name: 'main_tri_alpha')]
    public function trierAlpha(PokemonRepository $pokemonRepository,string $typeTrie ): Response
    {
        $direction = $typeTrie === 'asc' ? 'ASC' : 'DESC';
        $pokedex = $pokemonRepository->findBy([],['nom'=>$direction]);

        return $this->render('main/pokedex.html.twig', [
            "pokedex"=>$pokedex
        ]);
    }


    #[Route('/pokemon/tricapture/{tri}', name: 'main_tri_capt')]
    public function trierCapturer(PokemonRepository $pokemonRepository,int $tri ): Response
    {
        if($tri == 1){
            $pokedex = $pokemonRepository->findBy(['est_capture'=>true]);
        }else{
            $pokedex = $pokemonRepository->findBy(['est_capture'=>false]);
        }

        return $this->render('main/pokedex.html.twig', [
            "pokedex"=>$pokedex
        ]);
    }

//#[Route('/pokemon/ajouter', name: 'main_ajouterPokemon')]
//    public function ajouterPokemon(Request $request, EntityManagerInterface $entityManager):Response{
//        $pokemon = new Pokemon();
//        $pokemonForm = $this->createForm(PokemonType::class,$pokemon);
//        $pokemonForm->handleRequest($request);
//
//        if ($pokemonForm->isSubmitted()){
//            $entityManager->persist($pokemon);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('/');
//        }
//
//        return $this->render('main/ajouter.html.twig',[
//            '$pokemonForm'=>$pokemonForm
//        ]);
//    }







}
