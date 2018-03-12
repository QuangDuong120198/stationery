<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade" id="shopping-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight:bold;margin:0"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Giỏ hàng</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead style="background-color:#f5f5f0;text-transform:uppercase;">
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Đơn giá</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sản phẩm 1</td>
                            <td>10,000 đ</td>
                            <td>
                                <input type="number" min="1" value="1" style="width:40px;" />
                            </td>
                            <td>10,000 đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" style="float:right;" class="btn btn-default" data-dismiss="modal">Quay lại</button>
            </div>
        </div>
    </div>
</div>
