<?php

namespace App\Controller;

use App\Form\EleasticSearch\SearchFormType;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchPhrase;
use Elastica\Query\Range;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class SearchController extends AbstractController
{
     public function __construct(
         private readonly PaginatorInterface $paginator,
         private readonly PaginatedFinderInterface $finder,
     )
     {
     }

    #[Route('/search', name:'search')]
    public function index(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()  && $form->isValid())
        {

            $data = $form->getData();

            dump($data);
            $page = $request->query->getInt('page', 1);
            $boolQuery = new BoolQuery();


            if ($data->produit){
                $boolQuery->addMust(new MatchPhrase('id', $data->produit->getId()));
            }

            if ($data->createdThisMonth){
                $rangeQuery = new Range('createdAt', [
                    'gte' => (new \DateTimeImmutable('-1month'))->format('Y-m-d'),
                ]);
                $boolQuery->addFilter($rangeQuery);
            }

            if ($data->query) {
                $boolQuery->addMust(new MatchPhrase('description', $data->query));
            }

            $results = $this->finder->createPaginatorAdapter($boolQuery);
            $pagination = $this->paginator->paginate($results, $page);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination ?? []
        ]);
    }
    
}