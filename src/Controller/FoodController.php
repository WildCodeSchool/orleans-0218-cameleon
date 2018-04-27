<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 10/04/18
 * Time: 15:55
 */

namespace Controller;

use Model\AbstractManager;
use Model\FoodManager;

class FoodController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $foodManager = new FoodManager();
        $foods = $foodManager->selectFoodByCategory();
        $foodCategories = [];
        foreach ($foods as $food) {
            $foodCategories[$food['categoryName']][] = $food;
        }
        return $this->twig->render('food/list.html.twig', ['foodCategories' => $foodCategories]);
    }
}
