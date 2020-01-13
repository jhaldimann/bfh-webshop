<?php

class Product
{
    public $id;
    public $brand;
    public $size;
    public $category;
    public $price;
    public $quantity;
    public $gender;
    public $description;
    public $image;
    public $sale;
    public $percent;

    // Constructor
    function __construct($id, $brand, $size, $category, $price, $quantity,
                            $gender, $description, $image, $sale, $percent)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->size = $size;
        $this->category = $category;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->gender = $gender;
        $this->description = $description;
        $this->image = $image;
        $this->sale = $sale;
        $this->percent = $percent;

    }

    public function render() {
        $lang = "de";
        if(isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }
        $html = "<a class='product-link' href='?site=product&id={$this->id}&lang={$lang}'>" .
                    "<div class='product'>" .
                        "<img src='./images/uploads/{$this->image}' alt='{$this->description}'>" .
                        "<h3>{$this->brand} {$this->category}</h3>";
        if($this->sale) {
            $salePrice = $this->price * ((100 - $this->percent) / 100);
            $html .=    "<p class='percent'>".t('sale').": <label>{$this->percent}%</label></p>" .
                        "<p>".t('price').": <label>{$salePrice} CHF</label></p>";
        } else {
            $html .= "<p>".t('price').": <label>{$this->price} CHF</label></p>";
        }
        $html .=    "<p>".t('size').": <label>{$this->size}</label></p>" .
                    "<p>".t('quantity').": <label>{$this->quantity}</label></p>" .
                "</div>" .
            "</a>";
        echo $html;
    }

    public function render_details() {
        $productJSON = json_encode($this);

        $html = "<img class='product-image' src='./images/uploads/{$this->image}' alt='{$this->description}'/>
                <div class='information'>
                    <h2 class='description-title'>{$this->brand} {$this->description}</h2>
                    <label class='product-brand'><b>".t('brand').":</b> {$this->brand}</label>
                    <label class='product-description'><b>".t('description').":</b> {$this->description}</label>
                    <label class='product-size'><b>".t('size').":</b> {$this->size}</label>";
        if($this->sale) {
            $salePrice = $this->price * ((100 - $this->percent) / 100);
            $html .= "<label class='product-sale'><b>".t('sale').":</b> {$this->percent}%</label>
                        <label class='product-price'><b>".t('price').":</b> {$salePrice} CHF</label>";
        } else {
            $html .= "<label class='product-price'><b>".t('price').":</b> {$this->price} CHF</label>";
        }

        $html .=    "<div class='quantity-selection'>
                        <button class='quantity-count quantity-count-minus' onclick='updateQuantity(-1)'>-</button>
                        <input class='quantity-field' type='number' name='quantity' min='1' max='{$this->quantity}' value='1'>
                        <button class='quantity-count quantity-count-plus' onclick='updateQuantity(1)'>+</button>
                    </div>
                    </br>
                    <button class='add-to-cart' onclick='addToCart({$productJSON}); openDropDownWithTimeout(\"cart-dropdown\")'>
                        <img class='add-to-cart-image' src='./images/shoppingcart.png' alt='add to cart'/>
                        <label class='add-to-cart-label'>".t('add-to-cart')."</label>
                    </button>
                </div>";
        echo $html;
    }

    public function render_admin() {
        echo "<tr class='loaded-tr' onclick='selectField({$this->id})' id='product{$this->id}'>" .
                "<td>{$this->id}</td>" .
                "<td>{$this->brand}</td>" .
                "<td>{$this->category}</td>" .
                "<td>{$this->description}</td>" .
                "<td>{$this->size}</td>" .
                "<td>{$this->price}</td>" .
                "<td>{$this->gender}</td>" .
                "<td>{$this->quantity}</td>" .
                "<td>{$this->sale}</td>" .
                "<td>{$this->percent}</td>" .
                "<td>{$this->image}</td>" .
            "</tr>";
    }
}