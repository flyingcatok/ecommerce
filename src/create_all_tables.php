<?php
//Author: Feiyu Shi
//Date: 11/3/2013
//Last Edited: Feiyu Shi
//Date: 11/23/2013

/* list all tables here */

// Entities
include 'tables/create_customer_table.php';
include 'tables/create_employee_table.php';
include 'tables/create_item_table.php';
include 'tables/create_order_table.php';
// include 'tables/create_ministore_table.php';
// include 'tables/create_auction_table.php';
include 'tables/create_shipprice_table.php';

// Weak Entities

include 'tables/create_basket_table.php';// need to stay after customer tables is created.
include 'tables/create_addressbook_table.php';
include 'tables/create_paymentmethods_table.php';

// Realationships

include 'tables/create_ship_table.php';
include 'tables/create_promote_table.php';
include 'tables/create_basketcontains_table.php';
include 'tables/create_ordercontains_table.php';
// include 'tables/create_bid_table.php';
include 'tables/create_purchase_table.php';
// include 'tables/create_vipowns_table.php';
// include 'tables/create_upforauc_table.php';
include 'tables/create_shippedto_table.php';
include 'tables/create_billingaddress_table.php';
include 'tables/create_paidwith_table.php';
include 'tables/create_shippedby_table.php';
?>