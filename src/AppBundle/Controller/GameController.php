<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Game\Round;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    /**
     * @Template("AppBundle:Game:index.html.twig")
     * @param Player $player
     * @return array
     */
    public function indexAction(Player $player): array
    {
        return [
            'player' => $player,
        ];
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newGameAction(Request $request): Response
    {
        $player = $request->get('player');

        $em = $this->getDoctrine()->getManager();

        $player = new Player($player);
        $em->persist($player);
        $em->flush();

        return $this->redirectToRoute('game.index', [
            'player' => $player->getId(),
        ]);
    }


    /**
     * @param Player $player
     * @param Request $request
     * @return JsonResponse
     */
    public function playAction(Player $player, Request $request)
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
     * @return array
     */
    public function historyAction(Player $player): array
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

        $statGen = function($column) use ($history) {
            return array_count_values(array_column($history, $column));
        };

        $stats = [
            'Player Hand Stats' => $statGen('hand'),
            'Computer Hand Stats' => $statGen('computerHand'),
            'Game Outcomes' => $statGen('outcome'),
        ];

        return [
            'player' => $player,
            'games' => $history,
            'stats' => $stats,
        ];
    }
}