<?php

/* list all tables here */

// Entities
include 'tables/create_customer_table.php';
include 'tables/create_employee_table.php';
include 'tables/create_item_table.php';
include 'tables/create_order_table.php';
include 'tables/create_vip_table.php';
include 'tables/create_auction_table.php';

include 'tables/create_basket_table.php';// need to stay after customer tables is created.

// Realationships

include 'tables/create_ship_table.php';
include 'tables/create_promote_table.php';
include 'tables/create_basketcontains_table.php';
include 'tables/create_ordercontains_table.php';
?>