<?php 
if (!isset($_SESSION)) {
    include __DIR__ . '/../functions/functions.php';
    include __DIR__ . '/../config/config.php';
}

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 py-5 bg-white rounded shadow-sm mb-5">

            <!-- Shopping cart table -->
            <div class="table-responsive">
                <table id='tableCart' class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="400" class="border-0 bg-light">
                            <div class="p-2 px-3 text-uppercase">สินค้า (Product)</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase text-center">ราคา (Price)</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase text-center">จำนวน (Quantity)</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase text-center">ราคารวม (Total price)</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                            <div class="py-2 text-uppercase text-center"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allItems as $items) { ?>
                            <?php foreach ($items as $item) { ?>
                            <?php $infosProduct = $products->selectOneById($item['id']); ?>
                                <tr id="productLign-<?=$item['id'];?>">
                                    <th scope="row" class="border-0">
                                    <div class="p-2">
                                        <div class="d-inline-block align-middle">
                                            <h5 class="mb-0 text-dark d-inline-block align-middle"><?=$infosProduct['p_description'];?></h5>
                                            <span class="text-muted font-weight-normal font-italic d-block">
                                            <?php if(!empty($item['attributes']['color'])){ ?>
                                                Color: <strong><?=$item['attributes']['color'];?></strong><br/>
                                            <?php } ?>
                                            <?php if(!empty($item['attributes']['size'])){ ?>
                                                Size: <strong><?=$item['attributes']['size'];?></strong>
                                            <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                    </th>
                                    <td class="border-0 align-middle text-center"><strong><?=$infosProduct[$products->getGoodPrice($item)];?> THB</strong></td>
                                    <td class="border-0 align-middle text-center"><strong><?=$item['quantity'];?></strong></td>
                                    <td class="border-0 align-middle text-center"><strong><?= $products->calcPrice($item['quantity'], $infosProduct[$products->getGoodPrice($item)]) ;?> THB</strong></td>
                                    <td class="border-0 align-middle text-center"><a href="javascript:void(0);" data-id="<?=$item['id'];?>" data-color="<?=!empty($item['attributes']['color']) ? $item['attributes']['color'] : "" ;?>" data-size="<?=!empty($item['attributes']['size']) ? $item['attributes']['size'] : "" ;?>" class="text-dark del-to-cart"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tr>
                            <td class="border-0 align-middle">ราคารวมทั้งหมด (Grand Total)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="border-0 align-middle text-right"><strong><?=$products->sumAllPrices($allItems);?> THB</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End -->
        </div>
    </div>
</div>
