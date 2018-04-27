<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 18/04/18
 * Time: 09:41
 */

namespace Controller;

use Model\CategoryManager;
use Model\FoodManager;
use http\Exception;
use Structures\Notification;
use Structures\Session;
use Controller\AbstractController;

class FoodAdminController extends AbstractController
{
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $foodManager = new FoodManager();
        $foods = $foodManager->selectFoodByCategoryAdmin();
        $foodCategories = [];
        foreach ($foods as $food) {
            $foodCategories[$food['categoryId']]['name'] = $food['categoryName'];
            $foodCategories[$food['categoryId']]['produits'][] = $food;
        }
        return $this->twig->render('admin/food.html.twig', ['foodCategories' => $foodCategories, 'notification' => $notification]);
    }

    public function showProduct(int $id)
    {
        $productManager = new FoodManager();
        $categoryManager = new CategoryManager();
        $product = $productManager->selectOneById($id);
        $categories = $categoryManager->selectAll();

        return $this->twig->render('admin/showProduct.html.twig', ['product' => $product, 'categories' => $categories]);
    }

    public function showCategory(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);
        return $this->twig->render('admin/showCategory.html.twig', ['category' => $category]);
    }

    public function editCategory()
    {
        $categoryManager = new CategoryManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if (empty($cleanPost['name'])) {
                    throw new \Exception('Le nom de la catégorie ne peut pas être vide');
                }
                $categoryManager->update($cleanPost['id'], [
                    'name' => $cleanPost['name'],
                ]);
            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }


            header('location:/admin/menu');
            exit();
        }

    }

    public function editProduct()
    {
        $productManager = new FoodManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if (empty($cleanPost['name'])
                    OR empty($cleanPost['price'])
                    OR empty($cleanPost['category'])) {
                    throw new \Exception('Les champs obligatoires doivent être remplis');
                }
                $productManager->update($cleanPost['id'], [
                    'name' => $cleanPost['name'],
                    'price' => $cleanPost['price'],
                    'ingredients' => $cleanPost['ingredients'],
                    'category' => $cleanPost['category'],

                ]);

            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/menu');
        exit();

    }


    public function deleteProduct()
    {
        $foodManager = new FoodManager();
        $id = trim($_POST['id']);
        $notification = new Notification();
        $notification->setNotification('success', 'La suppression s\'est bien déroulée');
        try {
            if (empty($id) OR empty($foodManager->selectFirst($id))) {
                throw new \Exception('Le produit n\'existe pas');
            }
            $foodManager->delete($id);
        } catch (\Exception $e) {
            $notification->setNotification('danger', $e->getMessage());
        }
        header('location:/admin/menu');
        exit();
    }

    public function deleteCategory()
    {
        $categoryManager = new CategoryManager();
        $id = trim($_POST['id']);
        $notification = new Notification();
        $notification->setNotification('success', 'La suppression s\'est bien déroulée');
        try {
            if (empty($id) OR empty($categoryManager->selectFirst($id))) {
                throw new \Exception('La categorie n\'existe pas');
            }
            $categoryManager->delete($id);
        } catch (\Exception $e) {
            $notification->setNotification('danger', $e->getMessage());
        }
        header('location:/admin/menu');
        exit();
    }

    public function insertProduct()
    {
        $productManager = new FoodManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if (empty($cleanPost['name'])
                    OR empty($cleanPost['price'])
                    OR empty($cleanPost['category'])) {
                    throw new \Exception('Les champs obligatoires doivent être remplis');
                }
                $productManager->insert( [
                    'name' => $cleanPost['name'],
                    'price' => $cleanPost['price'],
                    'ingredients' => $cleanPost['ingredients'],
                    'category' => $cleanPost['category'],

                ]);

            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/menu');
        exit();
    }

    public function showNewProduct()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();
        return $this->twig->render('/admin/showNewProduct.html.twig', ['categories' => $categories]);
    }

    public function insertCategory()
    {
        $categoryManager = new CategoryManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if (empty($cleanPost['name'])) {
                    throw new \Exception('Le nom de la catégorie ne peut pas être vide');
                }
                $categoryManager->insert( [
                    'name' => $cleanPost['name'],
                ]);
            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }


            header('location:/admin/menu');
            exit();
        }
    }

    public function showNewCategory()
    {
        return $this->twig->render('/admin/showNewCategory.html.twig');
    }
}
