<?php 

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
class ImportController
{
	private const CORRECT_HEADERS = ['UID', 'Name', 'Age', 'Email', 'Phone', 'Gender'];
	public function uploadAction(RouteCollection $routes, Request $request)
	{
		$file = $request->files->get('inputFile');
		$data = file($file->getRealPath());

		if ($this->parseFile($data)) {
			
			$user = new User;
			$users = $user->all();

			require_once APP_ROOT . '/views/users.php';
		} else {
			require_once APP_ROOT . '/views/wrong_file.php';
		}

	}

	private function parseFile($data) {
		$headers = array_map('trim', explode(',', $data[0]));
		unset($data[0]);

		if(count($headers) == 6 && ImportController::CORRECT_HEADERS == $headers) {
			foreach($data as $d) {
				$dataLine = array_map('trim', explode(',', $d));
				$user = new User();
				if (!$user->find($dataLine[0])) {
					$user->create([
						'id' => $dataLine[0],
						'name' => $dataLine[1],
						'age' => $dataLine[2],
						'email' => $dataLine[3],
						'phone' => $dataLine[4],
						'gender' => $dataLine[5]
					]);
				} else {
					$user->update($dataLine[0], [
						'name' => $dataLine[1],
						'age' => $dataLine[2],
						'email' => $dataLine[3],
						'phone' => $dataLine[4],
						'gender' => $dataLine[5]
					]);
				}
			}

			return true;
		} else {
			return false;
		}
	}
}