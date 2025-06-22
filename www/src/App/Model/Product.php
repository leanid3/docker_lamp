<?php 

namespace Lamp\Leanid3\App\Model;
use Lamp\Leanid3\App\libs\Database;

class Product
{
    public $id;
    public $name;
    public $price;
    public $stock;

    public function __construct( int $id, string $name, float $price, int $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setStock(int $stock){
        $this->stock = $stock;
    }

    public function setPrice(float $price){
        $this->price = $price;
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock
        ];
    }

    public function toJson(){
        return json_encode($this->toArray());
    }


    public function save(Database $db){
        $db->insert('products', $this->toArray());
        $this->id = $db->lastInsertId();
        return $this;
    }

    public function update(Database $db){
        $db->update('products', $this->toArray(), ['id' => $this->id]);
        return $this;
    }

    public function delete(Database $db){
        $db->delete('products', ['id' => $this->id]);
        return $this;
    }

    public function find(Database $db, int $id){
        $product = $db->select('products', ['id' => $id]);
        return new Product($product['id'], $product['name'], $product['price'], $product['stock']);
    }

    public function findAll(Database $db){
        $products = $db->select('products');
        return array_map(function($product){
            return new Product($product['id'], $product['name'], $product['price'], $product['stock']);
        }, $products);
    }

    public function findBy(Database $db, array $criteria){
        $products = $db->select('products', $criteria);
        return array_map(function($product){
            return new Product($product['id'], $product['name'], $product['price'], $product['stock']);
        }, $products);
    }
    

}