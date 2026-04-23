<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ProductController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {}

    /**
     * Liste tous les produits.
     *
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    #[Route('/products', name: 'api_products_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        $jsonProducts = $this->serializer->serialize($products, 'json', ['groups' => 'product_list']);

        return new JsonResponse($jsonProducts, Response::HTTP_OK, [], true);
    }
}
