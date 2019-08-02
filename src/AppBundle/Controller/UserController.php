<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Users;
use AppBundle\Entity\Database;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    
    /**
     * @var Users
     */
    private $users;
    /**
     * @var Databases
     */
    private $databases;

    public function __construct(Users $usr, Database $databases) {
        $this->users = $usr;
        $this->databases = $databases;
    }
    
    /**
     * @Route("/admin/users")
     */
    public function userAction(Request $request)
    {

        $tables = $this->databases->getTables();

        $users = $this->users->getUsers();

        //$this->users->insertNewLine();

        //print_r($request->query->all());

        return $this->render('admin/base.html.twig', [
            'users' => $users,
            'tables' => $tables,
        ]);
    }
}
?>
