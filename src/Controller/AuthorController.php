<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\AuthorRepository;
use Doctrine\persistence\ManagerRegistry;
use App\Entity\Author;



final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpeg','username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg','username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }
    #[Route('/author/{id}', name: 'authorDetailes')]
    public function authorDetailes($id): Response
    {
        $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpeg','username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg','username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpeg','username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        return $this->render('author/showAuthor.html.twig', [
            'id' => $id,
            'authors' => $authors
             ]);
    }
    #[Route('/get', name: 'get_author')]
    public function getAllAuthors(AuthorRepository $authorRepo ): Response
    {
       $authors=$authorRepo->findAll();

        return $this->render('author/index.html.twig', [
            'authors' => 'Authors',
             ]);
    }
   #[Route('/add', name: 'add_author')]
    public function addAuthor(ManagerRegistry $em ): Response

    {
        $author1= new Author();
        $author1->setUsername('dua');
        $author1->setEmail('dua.hermassi@esprit.tn');
        
        
        $author2= new Author();
        $author2->setUsername('esprit');
        $author2->setEmail('douaa.hermassi@esprit.tn');

        
        $em->getManager()->persist($author1);
        $em->getManager()->persist($author2);
        $em->getManager()->flush();

        return new Response(' author added');
    }

    #[Route('/delete/{id}', name: 'delete')] 
    public function deleteAuthor($a, AuthorRepository $authorRepo, ManagerRegistry $em): Response
{
   $authors = $authorRepo->find($a);
   $em->getManager()->remove($author);
   $em->getManager()->flush();
}
#[Route('/update/{id}', name: 'update_author')]
public function updateAuthor($id, AuthorRepository $authorRepo, ManagerRegistry $em): Response
{
    $author = $authorRepo->find($id);

    if (!$author) {
        return new Response('Author not found');
    }

    // Exemple de modification :
    $author->setUsername('UpdatedName');
    $author->setEmail('updated.email@example.com');

    $em->getManager()->flush();

    return new Response('Author updated successfully!');
}



}
