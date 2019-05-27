<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $data = $this->getGoldArray();

        return $this->render('index.html.twig', [
            'golds' => $data,
        ]);
    }

    public function getGoldArray()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.nbp.pl/api/cenyzlota/last/20/?format=json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $response = curl_exec($ch);

        return json_decode($response,true);
    }
}
