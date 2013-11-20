<?php
//Author: Feiyu Shi
//Date: 11/7/2013
//Last Edited: Feiyu Shi
//Last Edit Date: 11/19/2013

//Entities
include 'insert/insert_customer.php';
include 'insert/insert_item.php';
include 'insert/insert_employee.php';
include 'insert/insert_shipprice.php';
include 'insert/insert_order.php';

include 'insert/insert_ministore.php';
include 'insert/insert_auction.php';

//weak entities
include 'insert/insert_addressbook.php';
include 'insert/insert_paymentmethods.php';
include 'insert/insert_basket.php';

//relationships
include 'insert/insert_billingaddress.php';
include 'insert/insert_purchase.php';
include 'insert/insert_basketcontains.php';
include 'insert/insert_ordercontains.php';
include 'insert/insert_ship.php';
include 'insert/insert_shippedto.php';
include 'insert/insert_promote.php';
include 'insert/insert_paidwith.php';
include 'insert/insert_shippedby.php';

include 'insert/insert_vipowns.php';
include 'insert/insert_upforauc.php';
include 'insert/insert_bid.php';

?>