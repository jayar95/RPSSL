<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Game\Round;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    /**
     * @param Player $player
     * @return JsonResponse
     */
    public function playerReadAction(Player $player): JsonResponse
    {
        return new JsonResponse([
            'player' => $player,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $request = json_decode($request->getContent());

        $player = $request->player;

        $em = $this->getDoctrine()->getManager();

        $player = new Player($player);
        $em->persist($player);
        $em->flush();

        return new JsonResponse([
            'player' => $player->getId(),
        ]);
    }


    /**
     * @param Player $player
     * @param Request $request
     * @return JsonResponse
     */
    public function playAction(Player $player, Request $request): JsonResponse
    {
        $request = json_decode($request->getContent());

        $hand = $request->hand;

        $round = new Round($hand);

        $em = $this->getDoctrine()->getManager();
        $game = new Game(
            $player,
            $round->hand->name,
            $round->computerHand->name,
            $round->result()
        );
        $em->persist($game);
        $em->flush();

        return new JsonResponse([
            'outcome' => $round->result(),
            'computer' => $round->computerHand->name,
        ]);
    }

    /**
     * @Template("AppBundle:Game:history.html.twig")
     * @param Player $player
     * @return JsonResponse
     */
    public function historyAction(Player $player): JsonResponse
    {
        $history = [];

        $gameRound = 1;
        foreach ($player->getGames() as $game) {
            $history[] = [
                'round' => $gameRound++,
                'hand' => $game->getPlayerHand(),
                'computerHand' => $game->getComputerHand(),
                'outcome' => $game->getOutcome(),
            ];
        }

        /**
         * Returns an associative array. Keys being the stat type, and the
         * values are the stat value
         *
         * @param $column
         *
         * @return array
         */
        $statGen = function($column) use ($history): array {
            return array_count_values(array_column($history, $column));
        };

        $stats = [
            'Player Hand Stats' => $statGen('hand'),
            'Computer Hand Stats' => $statGen('computerHand'),
            'Game Outcomes' => $statGen('outcome'),
        ];

        return new JsonResponse([
            'player' => $player,
            'games' => $history,
            'stats' => $stats,
        ]);
    }
}