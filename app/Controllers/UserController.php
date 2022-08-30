<?php 

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class UserController
{
    // Show user attributes based on the id.
	public function showAction(int $id, RouteCollection $routes)
	{
        $user = new User();
        $user->getOne($id);

        require_once APP_ROOT . '/views/user.php';
	}

     // Show all users.
	public function showAll(RouteCollection $routes)
	{
        $user = new User;
        $users = $user->all();

        require_once APP_ROOT . '/views/users.php';
	}

        public function deleteAll(RouteCollection $routes)
	{
        $user = new User;
        $users = $user->deleteAll();
        $users = $user->all();

        require_once APP_ROOT . '/views/users.php';
	}
}