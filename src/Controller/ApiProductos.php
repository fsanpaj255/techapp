<?php
 
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Producto;

#[Route("/api", name:"api_")]
class ApiProductos extends AbstractController
{
    
     #[Route("/producto/get", name:"project_index", methods:"GET")]
    public function getAllProductos(ManagerRegistry $doctrine): Response
    {
        $productos = $doctrine
            ->getRepository(Producto::class)
            ->findAll();
  
        $data = [];
  
        foreach ($productos as $producto) {
           $data[] = [
               'id' => $producto->getId(),
               'precio' => $producto->getPrecio(),
               'nombre' => $producto->getNombre(),
               'descripcion' => $producto->getDescripcion(),
               'ancho' => $producto->getAncho(),
               'largo' => $producto->getLargo(),
               'modelo' => $producto->getModelo(),
               'color' => $producto->getColor(),
               'peso' => $producto->getPeso(),
               'imageName' => $producto->getImageName()
           ];
        }
  
  
        return $this->json($data);
    }
 
  
     #[Route("/producto/post", name:"project_post2", methods:"POST")]
    public function ingresarProducto(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
  
        $producto = new Producto();
         $producto->setPrecio($request->request->get('precio'));
         $producto->setNombre($request->request->get('nombre'));
        $producto->setDescripcion($request->request->get('descripcion'));
        $producto->setAncho($request->request->get('ancho'));
        $producto->setLargo($request->request->get('largo'));
        $producto->setModelo($request->request->get('modelo'));
        $producto->setColor($request->request->get('color'));
        $producto->setPeso($request->request->get('peso'));
        $producto->setImageName($request->request->get('imageName'));
   
  
        $entityManager->persist($producto);
        $entityManager->flush();
  
        return $this->json('Ingresado nuevo producto con la id ' . $producto->getId());
    }
  
    
     #[Route("/producto/get/{id}", name:"project_show", methods:"GET")]
    public function getoneProducto(ManagerRegistry $doctrine, int $id): Response
    {
        $producto = $doctrine->getRepository(Producto::class)->find($id);
  
        if (!$producto) {
  
            return $this->json('No se ha encontrado un producto con la id=' . $id, 404);
        }
  
        $data =  [
         'id' => $producto->getId(),
               'precio' => $producto->getPrecio(),
               'nombre' => $producto->getNombre(),
               'descripcion' => $producto->getDescripcion(),
               'ancho' => $producto->getAncho(),
               'largo' => $producto->getLargo(),
               'modelo' => $producto->getModelo(),
               'color' => $producto->getColor(),
               'peso' => $producto->getPeso(),
               'imageName' => $producto->getImageName()
        ];
          
        return $this->json($data);
    }

    #[Route("/producto/buscar/{nombre}", name: "producto_buscar", methods: ["GET"])]
    public function buscarProductoPorNombre(Request $request, EntityManagerInterface $entityManager, $nombre): JsonResponse
    {
        $repository = $entityManager->getRepository(Producto::class);
        $producto = $repository->findOneBy(['nombre' => $nombre]);
    
        if (!$producto) {
            $response = [
                'message' => 'No se encontró un producto con el nombre: ' . $nombre,
                'status' => 404
            ];
            return new JsonResponse($response, 404);
        }
    
        $data = [
            'id' => $producto->getId(),
            'precio' => $producto->getPrecio(),
            'nombre' => $producto->getNombre(),
            'descripcion' => $producto->getDescripcion(),
            'tamano' => $producto->getTamano(),
            'modelo' => $producto->getModelo(),
            'color' => $producto->getColor(),
            'peso' => $producto->getPeso(),
            'imageName' => $producto->getImageName(),
            'categoria' => $producto->getCategoria()
        ];
    
        return new JsonResponse($data);
    }

    #[Route("/producto/categoria/{categoria}", name: "producto_por_categoria", methods: ["GET"])]
public function getProductosPorCategoria(Request $request, EntityManagerInterface $entityManager, $categoria): JsonResponse
{
    $repository = $entityManager->getRepository(Producto::class);
    $productos = $repository->findBy(['categoria' => $categoria]);

    if (empty($productos)) {
        $response = [
            'message' => 'No se encontraron productos en la categoría: ' . $categoria,
            'status' => 404
        ];
        return new JsonResponse($response, 404);
    }

    $data = [];
    foreach ($productos as $producto) {
        $data[] = [
            'id' => $producto->getId(),
            'precio' => $producto->getPrecio(),
            'nombre' => $producto->getNombre(),
            'descripcion' => $producto->getDescripcion(),
            'tamano' => $producto->getTamano(),
            'modelo' => $producto->getModelo(),
            'color' => $producto->getColor(),
            'peso' => $producto->getPeso(),
            'imageName' => $producto->getImageName(),
            'categoria' => $producto->getCategoria()
        ];
    }

    return new JsonResponse($data);
}
  
     #[Route("/producto/edit/{id}", name:"pdefbe", methods:"PUT")]
     public function edit(ManagerRegistry $doctrine, Request $request, int $id): Response
     {
         $entityManager = $doctrine->getManager();
         $producto = $entityManager->getRepository(Producto::class)->find($id);
  
         if (!$producto) {
             return $this->json('No se encontró producto para la id' . $id, 404);
         }
         $producto->setPrecio($request->request->get('precio'));
         $producto->setNombre($request->request->get('nombre'));
        $producto->setDescripcion($request->request->get('descripcion'));
        $producto->setAncho($request->request->get('ancho'));
        $producto->setLargo($request->request->get('largo'));
        $producto->setModelo($request->request->get('modelo'));
        $producto->setColor($request->request->get('color'));
        $producto->setPeso($request->request->get('peso'));
        $producto->setImageName($request->request->get('imageName'));
         $entityManager->flush();
  
         $data =  [
            'id' => $producto->getId(),
            'precio' => $producto->getPrecio(),
            'nombre' => $producto->getNombre(),
            'descripcion' => $producto->getDescripcion(),
            'ancho' => $producto->getAncho(),
            'largo' => $producto->getLargo(),
            'modelo' => $producto->getModelo(),
            'color' => $producto->getColor(),
            'peso' => $producto->getPeso(),
            'imageName' => $producto->getImageName()
         ];
 
         return $this->json($data);
     }
  
     #[Route("/producto/delete/{id}", name:"project_delete", methods:"DELETE")]
    public function deleteProducto(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $producto = $entityManager->getRepository(Producto::class)->find($id);
  
        if (!$producto) {
            return $this->json('No hay ningún producto con esta id=' . $id, 404);
        }
  
        $entityManager->remove($producto);
        $entityManager->flush();
//   
        return $this->json('Producto perfectamente borrada ' . $id);
    }
}