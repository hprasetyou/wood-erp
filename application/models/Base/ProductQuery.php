<?php

namespace Base;

use \Product as ChildProduct;
use \ProductQuery as ChildProductQuery;
use \Exception;
use \PDO;
use Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProductQuery orderByIsRound($order = Criteria::ASC) Order by the is_round column
 * @method     ChildProductQuery orderByIsKdn($order = Criteria::ASC) Order by the is_kdn column
 * @method     ChildProductQuery orderByIsFlegt($order = Criteria::ASC) Order by the is_flegt column
 * @method     ChildProductQuery orderByHasComponent($order = Criteria::ASC) Order by the has_component column
 * @method     ChildProductQuery orderByQtyPerPack($order = Criteria::ASC) Order by the qty_per_pack column
 * @method     ChildProductQuery orderByListPrice($order = Criteria::ASC) Order by the list_price column
 * @method     ChildProductQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 * @method     ChildProductQuery orderByUomId($order = Criteria::ASC) Order by the uom_id column
 * @method     ChildProductQuery orderByNote($order = Criteria::ASC) Order by the note column
 * @method     ChildProductQuery orderByCubicAsb($order = Criteria::ASC) Order by the cubic_asb column
 * @method     ChildProductQuery orderByCubicKdn($order = Criteria::ASC) Order by the cubic_kdn column
 * @method     ChildProductQuery orderByWidthAsb($order = Criteria::ASC) Order by the width_asb column
 * @method     ChildProductQuery orderByHeightAsb($order = Criteria::ASC) Order by the height_asb column
 * @method     ChildProductQuery orderByDepthAsb($order = Criteria::ASC) Order by the depth_asb column
 * @method     ChildProductQuery orderByWidthKdn($order = Criteria::ASC) Order by the width_kdn column
 * @method     ChildProductQuery orderByHeightKdn($order = Criteria::ASC) Order by the height_kdn column
 * @method     ChildProductQuery orderByDepthKdn($order = Criteria::ASC) Order by the depth_kdn column
 * @method     ChildProductQuery orderByNetCubic($order = Criteria::ASC) Order by the net_cubic column
 * @method     ChildProductQuery orderByNetWeight($order = Criteria::ASC) Order by the net_weight column
 * @method     ChildProductQuery orderByGrossWeight($order = Criteria::ASC) Order by the gross_weight column
 * @method     ChildProductQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildProductQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildProductQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductQuery groupById() Group by the id column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByDescription() Group by the description column
 * @method     ChildProductQuery groupByIsRound() Group by the is_round column
 * @method     ChildProductQuery groupByIsKdn() Group by the is_kdn column
 * @method     ChildProductQuery groupByIsFlegt() Group by the is_flegt column
 * @method     ChildProductQuery groupByHasComponent() Group by the has_component column
 * @method     ChildProductQuery groupByQtyPerPack() Group by the qty_per_pack column
 * @method     ChildProductQuery groupByListPrice() Group by the list_price column
 * @method     ChildProductQuery groupByMaterialId() Group by the material_id column
 * @method     ChildProductQuery groupByUomId() Group by the uom_id column
 * @method     ChildProductQuery groupByNote() Group by the note column
 * @method     ChildProductQuery groupByCubicAsb() Group by the cubic_asb column
 * @method     ChildProductQuery groupByCubicKdn() Group by the cubic_kdn column
 * @method     ChildProductQuery groupByWidthAsb() Group by the width_asb column
 * @method     ChildProductQuery groupByHeightAsb() Group by the height_asb column
 * @method     ChildProductQuery groupByDepthAsb() Group by the depth_asb column
 * @method     ChildProductQuery groupByWidthKdn() Group by the width_kdn column
 * @method     ChildProductQuery groupByHeightKdn() Group by the height_kdn column
 * @method     ChildProductQuery groupByDepthKdn() Group by the depth_kdn column
 * @method     ChildProductQuery groupByNetCubic() Group by the net_cubic column
 * @method     ChildProductQuery groupByNetWeight() Group by the net_weight column
 * @method     ChildProductQuery groupByGrossWeight() Group by the gross_weight column
 * @method     ChildProductQuery groupByType() Group by the type column
 * @method     ChildProductQuery groupByActive() Group by the active column
 * @method     ChildProductQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildProductQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildProductQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildProductQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildProductQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildProductQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildProductQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     ChildProductQuery leftJoinUnitOfMeasure($relationAlias = null) Adds a LEFT JOIN clause to the query using the UnitOfMeasure relation
 * @method     ChildProductQuery rightJoinUnitOfMeasure($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UnitOfMeasure relation
 * @method     ChildProductQuery innerJoinUnitOfMeasure($relationAlias = null) Adds a INNER JOIN clause to the query using the UnitOfMeasure relation
 *
 * @method     ChildProductQuery joinWithUnitOfMeasure($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UnitOfMeasure relation
 *
 * @method     ChildProductQuery leftJoinWithUnitOfMeasure() Adds a LEFT JOIN clause and with to the query using the UnitOfMeasure relation
 * @method     ChildProductQuery rightJoinWithUnitOfMeasure() Adds a RIGHT JOIN clause and with to the query using the UnitOfMeasure relation
 * @method     ChildProductQuery innerJoinWithUnitOfMeasure() Adds a INNER JOIN clause and with to the query using the UnitOfMeasure relation
 *
 * @method     ChildProductQuery leftJoinListComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the ListComponent relation
 * @method     ChildProductQuery rightJoinListComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ListComponent relation
 * @method     ChildProductQuery innerJoinListComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the ListComponent relation
 *
 * @method     ChildProductQuery joinWithListComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ListComponent relation
 *
 * @method     ChildProductQuery leftJoinWithListComponent() Adds a LEFT JOIN clause and with to the query using the ListComponent relation
 * @method     ChildProductQuery rightJoinWithListComponent() Adds a RIGHT JOIN clause and with to the query using the ListComponent relation
 * @method     ChildProductQuery innerJoinWithListComponent() Adds a INNER JOIN clause and with to the query using the ListComponent relation
 *
 * @method     ChildProductQuery leftJoinParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Parent relation
 * @method     ChildProductQuery rightJoinParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Parent relation
 * @method     ChildProductQuery innerJoinParent($relationAlias = null) Adds a INNER JOIN clause to the query using the Parent relation
 *
 * @method     ChildProductQuery joinWithParent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Parent relation
 *
 * @method     ChildProductQuery leftJoinWithParent() Adds a LEFT JOIN clause and with to the query using the Parent relation
 * @method     ChildProductQuery rightJoinWithParent() Adds a RIGHT JOIN clause and with to the query using the Parent relation
 * @method     ChildProductQuery innerJoinWithParent() Adds a INNER JOIN clause and with to the query using the Parent relation
 *
 * @method     ChildProductQuery leftJoinProductPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPartner relation
 * @method     ChildProductQuery rightJoinProductPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPartner relation
 * @method     ChildProductQuery innerJoinProductPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPartner relation
 *
 * @method     ChildProductQuery joinWithProductPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductPartner relation
 *
 * @method     ChildProductQuery leftJoinWithProductPartner() Adds a LEFT JOIN clause and with to the query using the ProductPartner relation
 * @method     ChildProductQuery rightJoinWithProductPartner() Adds a RIGHT JOIN clause and with to the query using the ProductPartner relation
 * @method     ChildProductQuery innerJoinWithProductPartner() Adds a INNER JOIN clause and with to the query using the ProductPartner relation
 *
 * @method     ChildProductQuery leftJoinProductFinishing($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildProductQuery rightJoinProductFinishing($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildProductQuery innerJoinProductFinishing($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery joinWithProductFinishing($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery leftJoinWithProductFinishing() Adds a LEFT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildProductQuery rightJoinWithProductFinishing() Adds a RIGHT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildProductQuery innerJoinWithProductFinishing() Adds a INNER JOIN clause and with to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery leftJoinProductImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinProductImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinProductImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductImage relation
 *
 * @method     ChildProductQuery joinWithProductImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductImage relation
 *
 * @method     ChildProductQuery leftJoinWithProductImage() Adds a LEFT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinWithProductImage() Adds a RIGHT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinWithProductImage() Adds a INNER JOIN clause and with to the query using the ProductImage relation
 *
 * @method     ChildProductQuery leftJoinProformaInvoiceLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildProductQuery rightJoinProformaInvoiceLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildProductQuery innerJoinProformaInvoiceLine($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProductQuery joinWithProformaInvoiceLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProductQuery leftJoinWithProformaInvoiceLine() Adds a LEFT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildProductQuery rightJoinWithProformaInvoiceLine() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildProductQuery innerJoinWithProformaInvoiceLine() Adds a INNER JOIN clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProductQuery leftJoinPurchaseOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildProductQuery rightJoinPurchaseOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildProductQuery innerJoinPurchaseOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrderLine relation
 *
 * @method     ChildProductQuery joinWithPurchaseOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildProductQuery leftJoinWithPurchaseOrderLine() Adds a LEFT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildProductQuery rightJoinWithPurchaseOrderLine() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildProductQuery innerJoinWithPurchaseOrderLine() Adds a INNER JOIN clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildProductQuery leftJoinProductStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductStock relation
 * @method     ChildProductQuery rightJoinProductStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductStock relation
 * @method     ChildProductQuery innerJoinProductStock($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductStock relation
 *
 * @method     ChildProductQuery joinWithProductStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductStock relation
 *
 * @method     ChildProductQuery leftJoinWithProductStock() Adds a LEFT JOIN clause and with to the query using the ProductStock relation
 * @method     ChildProductQuery rightJoinWithProductStock() Adds a RIGHT JOIN clause and with to the query using the ProductStock relation
 * @method     ChildProductQuery innerJoinWithProductStock() Adds a INNER JOIN clause and with to the query using the ProductStock relation
 *
 * @method     ChildProductQuery leftJoinStockMoveLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockMoveLine relation
 * @method     ChildProductQuery rightJoinStockMoveLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockMoveLine relation
 * @method     ChildProductQuery innerJoinStockMoveLine($relationAlias = null) Adds a INNER JOIN clause to the query using the StockMoveLine relation
 *
 * @method     ChildProductQuery joinWithStockMoveLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockMoveLine relation
 *
 * @method     ChildProductQuery leftJoinWithStockMoveLine() Adds a LEFT JOIN clause and with to the query using the StockMoveLine relation
 * @method     ChildProductQuery rightJoinWithStockMoveLine() Adds a RIGHT JOIN clause and with to the query using the StockMoveLine relation
 * @method     ChildProductQuery innerJoinWithStockMoveLine() Adds a INNER JOIN clause and with to the query using the StockMoveLine relation
 *
 * @method     \MaterialQuery|\UnitOfMeasureQuery|\ComponentProductQuery|\ProductPartnerQuery|\ProductFinishingQuery|\ProductImageQuery|\ProformaInvoiceLineQuery|\PurchaseOrderLineQuery|\ProductStockQuery|\StockMoveLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneById(int $id) Return the first ChildProduct filtered by the id column
 * @method     ChildProduct findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct findOneByDescription(string $description) Return the first ChildProduct filtered by the description column
 * @method     ChildProduct findOneByIsRound(boolean $is_round) Return the first ChildProduct filtered by the is_round column
 * @method     ChildProduct findOneByIsKdn(boolean $is_kdn) Return the first ChildProduct filtered by the is_kdn column
 * @method     ChildProduct findOneByIsFlegt(boolean $is_flegt) Return the first ChildProduct filtered by the is_flegt column
 * @method     ChildProduct findOneByHasComponent(boolean $has_component) Return the first ChildProduct filtered by the has_component column
 * @method     ChildProduct findOneByQtyPerPack(int $qty_per_pack) Return the first ChildProduct filtered by the qty_per_pack column
 * @method     ChildProduct findOneByListPrice(double $list_price) Return the first ChildProduct filtered by the list_price column
 * @method     ChildProduct findOneByMaterialId(int $material_id) Return the first ChildProduct filtered by the material_id column
 * @method     ChildProduct findOneByUomId(int $uom_id) Return the first ChildProduct filtered by the uom_id column
 * @method     ChildProduct findOneByNote(string $note) Return the first ChildProduct filtered by the note column
 * @method     ChildProduct findOneByCubicAsb(double $cubic_asb) Return the first ChildProduct filtered by the cubic_asb column
 * @method     ChildProduct findOneByCubicKdn(double $cubic_kdn) Return the first ChildProduct filtered by the cubic_kdn column
 * @method     ChildProduct findOneByWidthAsb(double $width_asb) Return the first ChildProduct filtered by the width_asb column
 * @method     ChildProduct findOneByHeightAsb(double $height_asb) Return the first ChildProduct filtered by the height_asb column
 * @method     ChildProduct findOneByDepthAsb(double $depth_asb) Return the first ChildProduct filtered by the depth_asb column
 * @method     ChildProduct findOneByWidthKdn(double $width_kdn) Return the first ChildProduct filtered by the width_kdn column
 * @method     ChildProduct findOneByHeightKdn(double $height_kdn) Return the first ChildProduct filtered by the height_kdn column
 * @method     ChildProduct findOneByDepthKdn(double $depth_kdn) Return the first ChildProduct filtered by the depth_kdn column
 * @method     ChildProduct findOneByNetCubic(double $net_cubic) Return the first ChildProduct filtered by the net_cubic column
 * @method     ChildProduct findOneByNetWeight(double $net_weight) Return the first ChildProduct filtered by the net_weight column
 * @method     ChildProduct findOneByGrossWeight(double $gross_weight) Return the first ChildProduct filtered by the gross_weight column
 * @method     ChildProduct findOneByType(string $type) Return the first ChildProduct filtered by the type column
 * @method     ChildProduct findOneByActive(boolean $active) Return the first ChildProduct filtered by the active column
 * @method     ChildProduct findOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column
 * @method     ChildProduct findOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(int $id) Return the first ChildProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $description) Return the first ChildProduct filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByIsRound(boolean $is_round) Return the first ChildProduct filtered by the is_round column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByIsKdn(boolean $is_kdn) Return the first ChildProduct filtered by the is_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByIsFlegt(boolean $is_flegt) Return the first ChildProduct filtered by the is_flegt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHasComponent(boolean $has_component) Return the first ChildProduct filtered by the has_component column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByQtyPerPack(int $qty_per_pack) Return the first ChildProduct filtered by the qty_per_pack column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByListPrice(double $list_price) Return the first ChildProduct filtered by the list_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByMaterialId(int $material_id) Return the first ChildProduct filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByUomId(int $uom_id) Return the first ChildProduct filtered by the uom_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByNote(string $note) Return the first ChildProduct filtered by the note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCubicAsb(double $cubic_asb) Return the first ChildProduct filtered by the cubic_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCubicKdn(double $cubic_kdn) Return the first ChildProduct filtered by the cubic_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWidthAsb(double $width_asb) Return the first ChildProduct filtered by the width_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHeightAsb(double $height_asb) Return the first ChildProduct filtered by the height_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDepthAsb(double $depth_asb) Return the first ChildProduct filtered by the depth_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWidthKdn(double $width_kdn) Return the first ChildProduct filtered by the width_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHeightKdn(double $height_kdn) Return the first ChildProduct filtered by the height_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDepthKdn(double $depth_kdn) Return the first ChildProduct filtered by the depth_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByNetCubic(double $net_cubic) Return the first ChildProduct filtered by the net_cubic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByNetWeight(double $net_weight) Return the first ChildProduct filtered by the net_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByGrossWeight(double $gross_weight) Return the first ChildProduct filtered by the gross_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByType(string $type) Return the first ChildProduct filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByActive(boolean $active) Return the first ChildProduct filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findById(int $id) Return ChildProduct objects filtered by the id column
 * @method     ChildProduct[]|ObjectCollection findByName(string $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $description) Return ChildProduct objects filtered by the description column
 * @method     ChildProduct[]|ObjectCollection findByIsRound(boolean $is_round) Return ChildProduct objects filtered by the is_round column
 * @method     ChildProduct[]|ObjectCollection findByIsKdn(boolean $is_kdn) Return ChildProduct objects filtered by the is_kdn column
 * @method     ChildProduct[]|ObjectCollection findByIsFlegt(boolean $is_flegt) Return ChildProduct objects filtered by the is_flegt column
 * @method     ChildProduct[]|ObjectCollection findByHasComponent(boolean $has_component) Return ChildProduct objects filtered by the has_component column
 * @method     ChildProduct[]|ObjectCollection findByQtyPerPack(int $qty_per_pack) Return ChildProduct objects filtered by the qty_per_pack column
 * @method     ChildProduct[]|ObjectCollection findByListPrice(double $list_price) Return ChildProduct objects filtered by the list_price column
 * @method     ChildProduct[]|ObjectCollection findByMaterialId(int $material_id) Return ChildProduct objects filtered by the material_id column
 * @method     ChildProduct[]|ObjectCollection findByUomId(int $uom_id) Return ChildProduct objects filtered by the uom_id column
 * @method     ChildProduct[]|ObjectCollection findByNote(string $note) Return ChildProduct objects filtered by the note column
 * @method     ChildProduct[]|ObjectCollection findByCubicAsb(double $cubic_asb) Return ChildProduct objects filtered by the cubic_asb column
 * @method     ChildProduct[]|ObjectCollection findByCubicKdn(double $cubic_kdn) Return ChildProduct objects filtered by the cubic_kdn column
 * @method     ChildProduct[]|ObjectCollection findByWidthAsb(double $width_asb) Return ChildProduct objects filtered by the width_asb column
 * @method     ChildProduct[]|ObjectCollection findByHeightAsb(double $height_asb) Return ChildProduct objects filtered by the height_asb column
 * @method     ChildProduct[]|ObjectCollection findByDepthAsb(double $depth_asb) Return ChildProduct objects filtered by the depth_asb column
 * @method     ChildProduct[]|ObjectCollection findByWidthKdn(double $width_kdn) Return ChildProduct objects filtered by the width_kdn column
 * @method     ChildProduct[]|ObjectCollection findByHeightKdn(double $height_kdn) Return ChildProduct objects filtered by the height_kdn column
 * @method     ChildProduct[]|ObjectCollection findByDepthKdn(double $depth_kdn) Return ChildProduct objects filtered by the depth_kdn column
 * @method     ChildProduct[]|ObjectCollection findByNetCubic(double $net_cubic) Return ChildProduct objects filtered by the net_cubic column
 * @method     ChildProduct[]|ObjectCollection findByNetWeight(double $net_weight) Return ChildProduct objects filtered by the net_weight column
 * @method     ChildProduct[]|ObjectCollection findByGrossWeight(double $gross_weight) Return ChildProduct objects filtered by the gross_weight column
 * @method     ChildProduct[]|ObjectCollection findByType(string $type) Return ChildProduct objects filtered by the type column
 * @method     ChildProduct[]|ObjectCollection findByActive(boolean $active) Return ChildProduct objects filtered by the active column
 * @method     ChildProduct[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProduct objects filtered by the created_at column
 * @method     ChildProduct[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProduct objects filtered by the updated_at column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, is_round, is_kdn, is_flegt, has_component, qty_per_pack, list_price, material_id, uom_id, note, cubic_asb, cubic_kdn, width_asb, height_asb, depth_asb, width_kdn, height_kdn, depth_kdn, net_cubic, net_weight, gross_weight, type, active, created_at, updated_at FROM product WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the is_round column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRound(true); // WHERE is_round = true
     * $query->filterByIsRound('yes'); // WHERE is_round = true
     * </code>
     *
     * @param     boolean|string $isRound The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByIsRound($isRound = null, $comparison = null)
    {
        if (is_string($isRound)) {
            $isRound = in_array(strtolower($isRound), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_IS_ROUND, $isRound, $comparison);
    }

    /**
     * Filter the query on the is_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByIsKdn(true); // WHERE is_kdn = true
     * $query->filterByIsKdn('yes'); // WHERE is_kdn = true
     * </code>
     *
     * @param     boolean|string $isKdn The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByIsKdn($isKdn = null, $comparison = null)
    {
        if (is_string($isKdn)) {
            $isKdn = in_array(strtolower($isKdn), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_IS_KDN, $isKdn, $comparison);
    }

    /**
     * Filter the query on the is_flegt column
     *
     * Example usage:
     * <code>
     * $query->filterByIsFlegt(true); // WHERE is_flegt = true
     * $query->filterByIsFlegt('yes'); // WHERE is_flegt = true
     * </code>
     *
     * @param     boolean|string $isFlegt The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByIsFlegt($isFlegt = null, $comparison = null)
    {
        if (is_string($isFlegt)) {
            $isFlegt = in_array(strtolower($isFlegt), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_IS_FLEGT, $isFlegt, $comparison);
    }

    /**
     * Filter the query on the has_component column
     *
     * Example usage:
     * <code>
     * $query->filterByHasComponent(true); // WHERE has_component = true
     * $query->filterByHasComponent('yes'); // WHERE has_component = true
     * </code>
     *
     * @param     boolean|string $hasComponent The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHasComponent($hasComponent = null, $comparison = null)
    {
        if (is_string($hasComponent)) {
            $hasComponent = in_array(strtolower($hasComponent), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_HAS_COMPONENT, $hasComponent, $comparison);
    }

    /**
     * Filter the query on the qty_per_pack column
     *
     * Example usage:
     * <code>
     * $query->filterByQtyPerPack(1234); // WHERE qty_per_pack = 1234
     * $query->filterByQtyPerPack(array(12, 34)); // WHERE qty_per_pack IN (12, 34)
     * $query->filterByQtyPerPack(array('min' => 12)); // WHERE qty_per_pack > 12
     * </code>
     *
     * @param     mixed $qtyPerPack The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByQtyPerPack($qtyPerPack = null, $comparison = null)
    {
        if (is_array($qtyPerPack)) {
            $useMinMax = false;
            if (isset($qtyPerPack['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_QTY_PER_PACK, $qtyPerPack['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtyPerPack['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_QTY_PER_PACK, $qtyPerPack['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_QTY_PER_PACK, $qtyPerPack, $comparison);
    }

    /**
     * Filter the query on the list_price column
     *
     * Example usage:
     * <code>
     * $query->filterByListPrice(1234); // WHERE list_price = 1234
     * $query->filterByListPrice(array(12, 34)); // WHERE list_price IN (12, 34)
     * $query->filterByListPrice(array('min' => 12)); // WHERE list_price > 12
     * </code>
     *
     * @param     mixed $listPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByListPrice($listPrice = null, $comparison = null)
    {
        if (is_array($listPrice)) {
            $useMinMax = false;
            if (isset($listPrice['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($listPrice['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice, $comparison);
    }

    /**
     * Filter the query on the material_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialId(1234); // WHERE material_id = 1234
     * $query->filterByMaterialId(array(12, 34)); // WHERE material_id IN (12, 34)
     * $query->filterByMaterialId(array('min' => 12)); // WHERE material_id > 12
     * </code>
     *
     * @see       filterByMaterial()
     *
     * @param     mixed $materialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByMaterialId($materialId = null, $comparison = null)
    {
        if (is_array($materialId)) {
            $useMinMax = false;
            if (isset($materialId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_MATERIAL_ID, $materialId, $comparison);
    }

    /**
     * Filter the query on the uom_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUomId(1234); // WHERE uom_id = 1234
     * $query->filterByUomId(array(12, 34)); // WHERE uom_id IN (12, 34)
     * $query->filterByUomId(array('min' => 12)); // WHERE uom_id > 12
     * </code>
     *
     * @see       filterByUnitOfMeasure()
     *
     * @param     mixed $uomId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByUomId($uomId = null, $comparison = null)
    {
        if (is_array($uomId)) {
            $useMinMax = false;
            if (isset($uomId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_UOM_ID, $uomId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uomId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_UOM_ID, $uomId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_UOM_ID, $uomId, $comparison);
    }

    /**
     * Filter the query on the note column
     *
     * Example usage:
     * <code>
     * $query->filterByNote('fooValue');   // WHERE note = 'fooValue'
     * $query->filterByNote('%fooValue%', Criteria::LIKE); // WHERE note LIKE '%fooValue%'
     * </code>
     *
     * @param     string $note The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByNote($note = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($note)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NOTE, $note, $comparison);
    }

    /**
     * Filter the query on the cubic_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByCubicAsb(1234); // WHERE cubic_asb = 1234
     * $query->filterByCubicAsb(array(12, 34)); // WHERE cubic_asb IN (12, 34)
     * $query->filterByCubicAsb(array('min' => 12)); // WHERE cubic_asb > 12
     * </code>
     *
     * @param     mixed $cubicAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCubicAsb($cubicAsb = null, $comparison = null)
    {
        if (is_array($cubicAsb)) {
            $useMinMax = false;
            if (isset($cubicAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cubicAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb, $comparison);
    }

    /**
     * Filter the query on the cubic_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByCubicKdn(1234); // WHERE cubic_kdn = 1234
     * $query->filterByCubicKdn(array(12, 34)); // WHERE cubic_kdn IN (12, 34)
     * $query->filterByCubicKdn(array('min' => 12)); // WHERE cubic_kdn > 12
     * </code>
     *
     * @param     mixed $cubicKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCubicKdn($cubicKdn = null, $comparison = null)
    {
        if (is_array($cubicKdn)) {
            $useMinMax = false;
            if (isset($cubicKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cubicKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn, $comparison);
    }

    /**
     * Filter the query on the width_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByWidthAsb(1234); // WHERE width_asb = 1234
     * $query->filterByWidthAsb(array(12, 34)); // WHERE width_asb IN (12, 34)
     * $query->filterByWidthAsb(array('min' => 12)); // WHERE width_asb > 12
     * </code>
     *
     * @param     mixed $widthAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWidthAsb($widthAsb = null, $comparison = null)
    {
        if (is_array($widthAsb)) {
            $useMinMax = false;
            if (isset($widthAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($widthAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb, $comparison);
    }

    /**
     * Filter the query on the height_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByHeightAsb(1234); // WHERE height_asb = 1234
     * $query->filterByHeightAsb(array(12, 34)); // WHERE height_asb IN (12, 34)
     * $query->filterByHeightAsb(array('min' => 12)); // WHERE height_asb > 12
     * </code>
     *
     * @param     mixed $heightAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHeightAsb($heightAsb = null, $comparison = null)
    {
        if (is_array($heightAsb)) {
            $useMinMax = false;
            if (isset($heightAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heightAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb, $comparison);
    }

    /**
     * Filter the query on the depth_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByDepthAsb(1234); // WHERE depth_asb = 1234
     * $query->filterByDepthAsb(array(12, 34)); // WHERE depth_asb IN (12, 34)
     * $query->filterByDepthAsb(array('min' => 12)); // WHERE depth_asb > 12
     * </code>
     *
     * @param     mixed $depthAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDepthAsb($depthAsb = null, $comparison = null)
    {
        if (is_array($depthAsb)) {
            $useMinMax = false;
            if (isset($depthAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depthAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb, $comparison);
    }

    /**
     * Filter the query on the width_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByWidthKdn(1234); // WHERE width_kdn = 1234
     * $query->filterByWidthKdn(array(12, 34)); // WHERE width_kdn IN (12, 34)
     * $query->filterByWidthKdn(array('min' => 12)); // WHERE width_kdn > 12
     * </code>
     *
     * @param     mixed $widthKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWidthKdn($widthKdn = null, $comparison = null)
    {
        if (is_array($widthKdn)) {
            $useMinMax = false;
            if (isset($widthKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($widthKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn, $comparison);
    }

    /**
     * Filter the query on the height_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByHeightKdn(1234); // WHERE height_kdn = 1234
     * $query->filterByHeightKdn(array(12, 34)); // WHERE height_kdn IN (12, 34)
     * $query->filterByHeightKdn(array('min' => 12)); // WHERE height_kdn > 12
     * </code>
     *
     * @param     mixed $heightKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHeightKdn($heightKdn = null, $comparison = null)
    {
        if (is_array($heightKdn)) {
            $useMinMax = false;
            if (isset($heightKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heightKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn, $comparison);
    }

    /**
     * Filter the query on the depth_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByDepthKdn(1234); // WHERE depth_kdn = 1234
     * $query->filterByDepthKdn(array(12, 34)); // WHERE depth_kdn IN (12, 34)
     * $query->filterByDepthKdn(array('min' => 12)); // WHERE depth_kdn > 12
     * </code>
     *
     * @param     mixed $depthKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDepthKdn($depthKdn = null, $comparison = null)
    {
        if (is_array($depthKdn)) {
            $useMinMax = false;
            if (isset($depthKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depthKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn, $comparison);
    }

    /**
     * Filter the query on the net_cubic column
     *
     * Example usage:
     * <code>
     * $query->filterByNetCubic(1234); // WHERE net_cubic = 1234
     * $query->filterByNetCubic(array(12, 34)); // WHERE net_cubic IN (12, 34)
     * $query->filterByNetCubic(array('min' => 12)); // WHERE net_cubic > 12
     * </code>
     *
     * @param     mixed $netCubic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByNetCubic($netCubic = null, $comparison = null)
    {
        if (is_array($netCubic)) {
            $useMinMax = false;
            if (isset($netCubic['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netCubic['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic, $comparison);
    }

    /**
     * Filter the query on the net_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByNetWeight(1234); // WHERE net_weight = 1234
     * $query->filterByNetWeight(array(12, 34)); // WHERE net_weight IN (12, 34)
     * $query->filterByNetWeight(array('min' => 12)); // WHERE net_weight > 12
     * </code>
     *
     * @param     mixed $netWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByNetWeight($netWeight = null, $comparison = null)
    {
        if (is_array($netWeight)) {
            $useMinMax = false;
            if (isset($netWeight['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_WEIGHT, $netWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netWeight['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_WEIGHT, $netWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NET_WEIGHT, $netWeight, $comparison);
    }

    /**
     * Filter the query on the gross_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByGrossWeight(1234); // WHERE gross_weight = 1234
     * $query->filterByGrossWeight(array(12, 34)); // WHERE gross_weight IN (12, 34)
     * $query->filterByGrossWeight(array('min' => 12)); // WHERE gross_weight > 12
     * </code>
     *
     * @param     mixed $grossWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByGrossWeight($grossWeight = null, $comparison = null)
    {
        if (is_array($grossWeight)) {
            $useMinMax = false;
            if (isset($grossWeight['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_GROSS_WEIGHT, $grossWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grossWeight['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_GROSS_WEIGHT, $grossWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_GROSS_WEIGHT, $grossWeight, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Material object
     *
     * @param \Material|ObjectCollection $material The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByMaterial($material, $comparison = null)
    {
        if ($material instanceof \Material) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_MATERIAL_ID, $material->getId(), $comparison);
        } elseif ($material instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_MATERIAL_ID, $material->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMaterial() only accepts arguments of type \Material or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Material relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinMaterial($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Material');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Material');
        }

        return $this;
    }

    /**
     * Use the Material relation Material object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MaterialQuery A secondary query class using the current class as primary query
     */
    public function useMaterialQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Material', '\MaterialQuery');
    }

    /**
     * Filter the query by a related \UnitOfMeasure object
     *
     * @param \UnitOfMeasure|ObjectCollection $unitOfMeasure The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByUnitOfMeasure($unitOfMeasure, $comparison = null)
    {
        if ($unitOfMeasure instanceof \UnitOfMeasure) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_UOM_ID, $unitOfMeasure->getId(), $comparison);
        } elseif ($unitOfMeasure instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_UOM_ID, $unitOfMeasure->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUnitOfMeasure() only accepts arguments of type \UnitOfMeasure or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UnitOfMeasure relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinUnitOfMeasure($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UnitOfMeasure');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UnitOfMeasure');
        }

        return $this;
    }

    /**
     * Use the UnitOfMeasure relation UnitOfMeasure object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UnitOfMeasureQuery A secondary query class using the current class as primary query
     */
    public function useUnitOfMeasureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnitOfMeasure($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UnitOfMeasure', '\UnitOfMeasureQuery');
    }

    /**
     * Filter the query by a related \ComponentProduct object
     *
     * @param \ComponentProduct|ObjectCollection $componentProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByListComponent($componentProduct, $comparison = null)
    {
        if ($componentProduct instanceof \ComponentProduct) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $componentProduct->getProductId(), $comparison);
        } elseif ($componentProduct instanceof ObjectCollection) {
            return $this
                ->useListComponentQuery()
                ->filterByPrimaryKeys($componentProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByListComponent() only accepts arguments of type \ComponentProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ListComponent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinListComponent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ListComponent');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ListComponent');
        }

        return $this;
    }

    /**
     * Use the ListComponent relation ComponentProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComponentProductQuery A secondary query class using the current class as primary query
     */
    public function useListComponentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinListComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ListComponent', '\ComponentProductQuery');
    }

    /**
     * Filter the query by a related \ComponentProduct object
     *
     * @param \ComponentProduct|ObjectCollection $componentProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByParent($componentProduct, $comparison = null)
    {
        if ($componentProduct instanceof \ComponentProduct) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $componentProduct->getComponentId(), $comparison);
        } elseif ($componentProduct instanceof ObjectCollection) {
            return $this
                ->useParentQuery()
                ->filterByPrimaryKeys($componentProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParent() only accepts arguments of type \ComponentProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Parent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinParent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Parent');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Parent');
        }

        return $this;
    }

    /**
     * Use the Parent relation ComponentProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComponentProductQuery A secondary query class using the current class as primary query
     */
    public function useParentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Parent', '\ComponentProductQuery');
    }

    /**
     * Filter the query by a related \ProductPartner object
     *
     * @param \ProductPartner|ObjectCollection $productPartner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductPartner($productPartner, $comparison = null)
    {
        if ($productPartner instanceof \ProductPartner) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productPartner->getProductId(), $comparison);
        } elseif ($productPartner instanceof ObjectCollection) {
            return $this
                ->useProductPartnerQuery()
                ->filterByPrimaryKeys($productPartner->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductPartner() only accepts arguments of type \ProductPartner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPartner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductPartner($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPartner');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductPartner');
        }

        return $this;
    }

    /**
     * Use the ProductPartner relation ProductPartner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductPartnerQuery A secondary query class using the current class as primary query
     */
    public function useProductPartnerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductPartner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPartner', '\ProductPartnerQuery');
    }

    /**
     * Filter the query by a related \ProductFinishing object
     *
     * @param \ProductFinishing|ObjectCollection $productFinishing the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductFinishing($productFinishing, $comparison = null)
    {
        if ($productFinishing instanceof \ProductFinishing) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productFinishing->getProductId(), $comparison);
        } elseif ($productFinishing instanceof ObjectCollection) {
            return $this
                ->useProductFinishingQuery()
                ->filterByPrimaryKeys($productFinishing->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductFinishing() only accepts arguments of type \ProductFinishing or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductFinishing relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductFinishing($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductFinishing');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductFinishing');
        }

        return $this;
    }

    /**
     * Use the ProductFinishing relation ProductFinishing object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductFinishingQuery A secondary query class using the current class as primary query
     */
    public function useProductFinishingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductFinishing($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductFinishing', '\ProductFinishingQuery');
    }

    /**
     * Filter the query by a related \ProductImage object
     *
     * @param \ProductImage|ObjectCollection $productImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductImage($productImage, $comparison = null)
    {
        if ($productImage instanceof \ProductImage) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productImage->getProductId(), $comparison);
        } elseif ($productImage instanceof ObjectCollection) {
            return $this
                ->useProductImageQuery()
                ->filterByPrimaryKeys($productImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductImage() only accepts arguments of type \ProductImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductImage');
        }

        return $this;
    }

    /**
     * Use the ProductImage relation ProductImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductImageQuery A secondary query class using the current class as primary query
     */
    public function useProductImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductImage', '\ProductImageQuery');
    }

    /**
     * Filter the query by a related \ProformaInvoiceLine object
     *
     * @param \ProformaInvoiceLine|ObjectCollection $proformaInvoiceLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLine($proformaInvoiceLine, $comparison = null)
    {
        if ($proformaInvoiceLine instanceof \ProformaInvoiceLine) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $proformaInvoiceLine->getProductId(), $comparison);
        } elseif ($proformaInvoiceLine instanceof ObjectCollection) {
            return $this
                ->useProformaInvoiceLineQuery()
                ->filterByPrimaryKeys($proformaInvoiceLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProformaInvoiceLine() only accepts arguments of type \ProformaInvoiceLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProformaInvoiceLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProformaInvoiceLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProformaInvoiceLine');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProformaInvoiceLine');
        }

        return $this;
    }

    /**
     * Use the ProformaInvoiceLine relation ProformaInvoiceLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProformaInvoiceLineQuery A secondary query class using the current class as primary query
     */
    public function useProformaInvoiceLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProformaInvoiceLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProformaInvoiceLine', '\ProformaInvoiceLineQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrderLine object
     *
     * @param \PurchaseOrderLine|ObjectCollection $purchaseOrderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrderLine($purchaseOrderLine, $comparison = null)
    {
        if ($purchaseOrderLine instanceof \PurchaseOrderLine) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $purchaseOrderLine->getProductId(), $comparison);
        } elseif ($purchaseOrderLine instanceof ObjectCollection) {
            return $this
                ->usePurchaseOrderLineQuery()
                ->filterByPrimaryKeys($purchaseOrderLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseOrderLine() only accepts arguments of type \PurchaseOrderLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseOrderLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinPurchaseOrderLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseOrderLine');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PurchaseOrderLine');
        }

        return $this;
    }

    /**
     * Use the PurchaseOrderLine relation PurchaseOrderLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PurchaseOrderLineQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseOrderLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseOrderLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrderLine', '\PurchaseOrderLineQuery');
    }

    /**
     * Filter the query by a related \ProductStock object
     *
     * @param \ProductStock|ObjectCollection $productStock the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductStock($productStock, $comparison = null)
    {
        if ($productStock instanceof \ProductStock) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productStock->getProductId(), $comparison);
        } elseif ($productStock instanceof ObjectCollection) {
            return $this
                ->useProductStockQuery()
                ->filterByPrimaryKeys($productStock->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductStock() only accepts arguments of type \ProductStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductStock relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductStock($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductStock');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductStock');
        }

        return $this;
    }

    /**
     * Use the ProductStock relation ProductStock object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductStockQuery A secondary query class using the current class as primary query
     */
    public function useProductStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductStock', '\ProductStockQuery');
    }

    /**
     * Filter the query by a related \StockMoveLine object
     *
     * @param \StockMoveLine|ObjectCollection $stockMoveLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByStockMoveLine($stockMoveLine, $comparison = null)
    {
        if ($stockMoveLine instanceof \StockMoveLine) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $stockMoveLine->getProductId(), $comparison);
        } elseif ($stockMoveLine instanceof ObjectCollection) {
            return $this
                ->useStockMoveLineQuery()
                ->filterByPrimaryKeys($stockMoveLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStockMoveLine() only accepts arguments of type \StockMoveLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockMoveLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinStockMoveLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockMoveLine');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'StockMoveLine');
        }

        return $this;
    }

    /**
     * Use the StockMoveLine relation StockMoveLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StockMoveLineQuery A secondary query class using the current class as primary query
     */
    public function useStockMoveLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockMoveLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockMoveLine', '\StockMoveLineQuery');
    }

    /**
     * Filter the query by a related Finishing object
     * using the product_finishing table as cross reference
     *
     * @param Finishing $finishing the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByFinishing($finishing, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useProductFinishingQuery()
            ->filterByFinishing($finishing, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_ID, $product->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
