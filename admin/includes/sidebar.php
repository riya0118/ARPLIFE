<?php require_once("constants.php"); ?>
<style>
    .customalinks {
        background-color: black !important;
        color: white !important;
    }

    .customalinks:hover {
        background-color: darkslateblue !important;
    }


    .customspan {
        color: white !important;
        font-size: small;
        padding-left: 7px;
        background: transparent;
    }

    .customicon {
        color: white !important;
        font-size: large;
    }
</style>
<div class="nk-sidebar" style="padding-bottom: 0px; background-color: black ;  ">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="customalinks" href="<?php echo BASE_DIR . 'index.php' ?>">
                    <span class="ti-view-list-alt customicon"></span>
                    <span class="nav-text customspan ">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="customalinks has-arrow " href="javascript:void()" aria-expanded="false">
                    <span class="ti-tag customicon"></span>
                    <span class="nav-text customspan">Catalog</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a class="customalinks has-arrow" aria-expanded="false" href="javascript:void()">Product Categorization</a>
                        <ul aria-expanded="false">
                            <li>
                                <a class="customalinks " href="<?php echo BASE_DIR . 'categories.php' ?>">Categories</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_DIR . 'subcategories.php' ?>" class="customalinks">Sub Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="customalinks has-arrow" aria-expanded="false" href="javascript:void()">Products</a>
                        <ul aria-expanded="false">
                            <li>
                                <a class="customalinks" href="<?php echo BASE_DIR . 'products.php' ?>">Products</a>
                            </li>
                            <li>
                                <a class="customalinks" href="<?php echo BASE_DIR . 'attributes.php' ?>">Attributes</a>
                            </li>
                            <li>
                                <a class="customalinks" href="<?php echo BASE_DIR . 'brands.php' ?>">Brands</a>
                            </li>
                            <li>
                            <a class="customalinks" href="<?php echo BASE_DIR . 'size.php' ?>">Size</a>
                            </li>
                            <li>
                            <a class="customalinks" href="<?php echo BASE_DIR . 'color.php' ?>">Color</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a class="customalinks has-arrow" aria-expanded="false" href="javascript:void()"><span class="ti-shopping-cart-full customicon"></span>
                    <span class="nav-text customspan"> Sales</span>
                </a>
                <ul>
                    <li>
                        <a class="customalinks " href="<?php echo BASE_DIR . 'orders.php' ?>">Orders</a>
                    </li>
                    <li>
                        <a class="customalinks " href="<?php echo BASE_DIR . 'productdiscounts.php' ?>">Product Discounts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="customalinks has-arrow" aria-expanded="false" href="javascript:void()">
                    <span class="ti-user customicon"></span>
                    <span class="nav-text customspan">Customers</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a class="customalinks " href="<?php echo BASE_DIR . 'customersdetail.php' ?>">Customers</a>
                    </li>
                    <li>
                        <a class="customalinks " href="<?php echo BASE_DIR . 'coupons.php' ?>">Coupons</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>