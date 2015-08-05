<?php
## Visibility list as defined in Magento
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE ==> 1
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG ==> 2
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_SEARCH ==> 3
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH ==> 4

## Fetch products with status "Enabled" and visible in both catalog & search.
$visibility = array(
  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
);
$products = Mage::getModel('catalog/product')->getCollection();
$products->addAttributeToSelect('*');
$products->addAttributeToFilter('status', 1);
$products->addAttributeToFilter('visibility', 4);
## or ##
$products->addAttributeToFilter('visibility', $visibility);

## Get categories of only enabled and visible products
$categories = array();
$products = Mage::getModel('catalog/product')->getCollection();
$products->addAttributeToFilter('status', 1);
$products->addAttributeToFilter('visibility', 4);
## or ##
$products->addAttributeToFilter('visibility', $visibility);
foreach($products as $product) {
  foreach($product->getCategoryIds() as $cat) {
     $categories[] = $cat;
  }
}
$categories = array_values(array_unique($categories));

?>
