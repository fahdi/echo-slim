<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Use POST /echo with JSON data');
        return $response;
    });

	$app->post('/echo', function (Request $request, Response $response) {
		try {
			$response = $response->withHeader('Content-type', 'application/json');
			$json = file_get_contents('php://input');
			
			if (empty($json)) {
				throw new Exception('No data received');
			}

			$response->getBody()->write($json);

			// Ensure logs directory exists
			if (!file_exists('../logs')) {
				mkdir('../logs', 0777, true);
			}

			// Save the raw JSON to a file
			$timestamp = date('Y-m-d_H-i-s');
			$filename = "../logs/echo_data_{$timestamp}.json";
			file_put_contents($filename, $json);

			// Also update the log file
			$myfile = fopen("../logs/log.txt", "a") or die("Unable to open file!");
			$txt = "Data received from the post:\n";
			fwrite($myfile, $txt);
			$txt = "Saved to file: {$filename}\n";
			fwrite($myfile, $txt);
			$txt = print_r($_POST, true) . "\n\n-----------------------\n\n";
			fwrite($myfile, $txt);
			fclose($myfile);

			return $response;
		} catch (Exception $e) {
			$response->getBody()->write(json_encode(['error' => $e->getMessage()]));
			return $response->withStatus(400);
		}
	});

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
