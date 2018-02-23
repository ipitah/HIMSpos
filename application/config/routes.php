<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route["sumchart"] = "Summarychart";
$route["Charts"] = "Charts";
$route["finalise_sale"] = "Finalisesale";
$route["batch_delete"] = "Batch_delete";
$route["update_staff"] = "Updatestaffs";
$route["update_spoilt"] = "Updatespoilt";
$route["dispspoilt"] = "Dispspoilt";
$route["update_item"] = "Updateitem";
$route["update_supplier"] = "Updatesupplier";
$route["update_customer"] = "Updatecustomer";
$route["updatecategory"] = "Updatecategory";
$route["changepass"] = "Changepass";

$route["saleorder"] = "Saleorder";
$route["dispsaleorder"] = "Dispsaleorder";
$route["dispcustomer"] = "Dispcustomer";
$route["dispsupplier"] = "Dispsupplier";
$route["dispstaffs"] = "Dispstaffs";
$route["Staffs"] = "Staffs";
$route["summary"] = "Summary";
$route["endofday"] = "Endday";
$route["dispcategory"] = "Dispcategory";
$route["additem"] = "Additem/load";
$route["category"] = "Category";
$route["purchaseorder"] = "Order/load";
$route["Purchase"] = "Purchase";
$route["order"] = "Order";
$route["Sale"] = "Sale";
$route["disppurchaseorder"] = "Disppurchaseorder";
$route["deletesale"] = "Deletesale";
$route["showreceipts"] = "Dispsale";
$route["stockremlist"] = "Dispremstock";
$route["addspt"] = "Spoilt";
$route["addspoilt"] = "Spoilt/load";
$route["addstock"] = "Purchase/load";
$route["home"] = "Sale/load";
$route["salesorder"] = "Saleorder/load";
$route["sales"] = "Dispsale";
$route["stocklist"] = "Dispstock";
$route["Dispitem"] = "Dispitem";
$route["itemslist"] = "Dispitem";
$route["add_item"] = "Additem";
$route["add_customer"] = "Addcustomer";
$route["add_supplier"] = "Addsupplier";
$route["logout"] = "logout";
$route["loginform"] = "Login";
$route["(:any)"] = "pages/view/$1";
//$route['about'] = 'index.php/pages/view/about';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
