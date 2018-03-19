<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal" id="shopping-list">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-dark">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#f5f5f0;">&times;</button>
                <h4 style="margin:0;"><strong><i class="fa fa-shopping-cart"></i>&nbsp;Danh sách đặt hàng</strong></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid inner-cart">
<?php if(get_cookie('cart')): ?>
<?php foreach(json_decode(get_cookie('cart'),TRUE) as $row): ?>
                    
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
