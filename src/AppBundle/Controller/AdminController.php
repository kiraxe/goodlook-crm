<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Users;
use AppBundle\Entity\Database;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
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
     * @Route("/admins/")
     */
    public function adminAction(Request $request)
    {

        $users = null;
        $tables = $this->databases->getTables();

        //print_r($request->query->all());

        return $this->render('admin/base.html.twig', [
            'users' => $users,
            'tables' => $tables,
        ]);
    }
}
?>