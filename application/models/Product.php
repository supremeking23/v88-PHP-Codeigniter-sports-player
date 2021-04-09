<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model {
    function get_all_products()
    {
        return $this->db->query("SELECT * FROM products")->result_array();
    }
    function get_product_by_id($product_id)
    {
        return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
    }
    function add_product($product)
    {
        $query = "INSERT INTO products (product_name, description,price, created_at) VALUES (?,?,?,?)";
        $values = array($product['product_name'], $product['description'], $product['price'], date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }

    function update_product($product)
    {
        $query = "UPDATE products SET product_name = ?, description = ?, price = ?, updated_at = ? WHERE id = ?";
        $values = array($product['product_name'], $product['description'], $product['price'], date("Y-m-d, H:i:s"),$product['product_id']); 
        return $this->db->query($query, $values);
    }

    function delete_product($product_id){
        $query = "DELETE FROM products WHERE id = ?";
        $value = array($product_id);
        return $this->db->query($query,$value);
    }
}

?>