<?php 

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class TodoController extends AbstractController
{   
    #[Route(path:'/todo', name: 'todo')]
    public function index():Response
    {
        $user = $this->getUser() ;
        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('Todos/Todos.html.twig', ['todos' => $user->getTodos()]);
    }

    #[Route(path:'/todo/create', name: 'todo_create')]
    public function create(Request $request , EntityManagerInterface $entityManager):Response
    {   
        $todo = new Todo();
        $todo->setDescription($request->get('description'));
        $todo->setUser($this->getUser());
        $entityManager->persist($todo);
        $entityManager->flush();
        return $this->redirectToRoute('todo');
    }

    #[Route(path:'/todo/delete/{id}', name: 'todo_delete')]
    public function delete(Todo $todo , EntityManagerInterface $entityManager):Response
    {
        $entityManager->remove($todo);
        $entityManager->flush();
        return $this->redirectToRoute('todo');
    }   
}