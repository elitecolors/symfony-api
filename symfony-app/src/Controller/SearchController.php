<?php

declare(strict_types=1);

namespace App\Controller;

use Elastica\Util;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/search', name: 'app_search')]
class SearchController extends BaseController
{
    #[Route('/products', name: '_products', methods: 'GET')]
    public function searchAction(Request $request, TransformedFinder $productsFinder) : Response
    {

        $search = Util::escapeTerm($request->query->get('q'));

        $result = $productsFinder->find($search, 10);

        return $this->createApiResponse(['data' => $result]);
    }

}
