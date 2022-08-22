@extends('emails.layout_shop')
@section('content')
    Kính gửi: ....
@stop
@section('table-bill')
    <table style="width:100%;border-collapse: collapse;">
        <tr style="background-color:#8fbdfd;">
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;white-space: nowrap;">STT</th>
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;">Tên sản phẩm</th>
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;white-space: nowrap;">Bảo hành</th>
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;white-space: nowrap;">Đơn giá</th>
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;white-space: nowrap;">Số lượng</th>
            <th style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding:5px;border: 1px solid #f9f9f9;border-collapse: collapse;white-space: nowrap;">Thành tiền</th>
        </tr>
        @php
            $subTotal = 0;
            $total = 0;
            $shipFee = 0;
        @endphp

        @if ($detailOrders && count($detailOrders))
            @foreach ($detailOrders->load('product') as $productOrder)
                <tr>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;white-space: nowrap;">{{ $loop->index + 1 }}</td>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;">{{ $productOrder->product->title }}</td>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;">{{ $productOrder->product->warranty }}</td>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;white-space: nowrap;">{{ numberFormat($productOrder->product_price) }}</td>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;white-space: nowrap;">{{ $productOrder->product_qty }}</td>
                    <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding:5px;border: 1px solid #d3d2d2;border-collapse: collapse;white-space: nowrap;">{{ numberFormat($productOrder->product_total) }}</td>
                </tr>
                @php $subTotal += $productOrder->product_total; @endphp
            @endforeach
        @endif

        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding-bottom:5px;padding-top:5px;">Sub total</td>
            <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding-bottom:5px;padding-top:5px;white-space: nowrap;">{{ numberFormat($subTotal) }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding-bottom:5px;padding-top:5px;">Shipping fee:</td>
            <td style="margin:0;padding:0;font-size:13px;color:#232323;font-family:Roboto,Geneva,sans-serif;font-weight:normal;line-height: 18px;padding-bottom:5px;padding-top:5px;white-space: nowrap;">{{ $shipFee }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding-bottom:5px;padding-top:5px;background:#8fbdfd;">Total</td>
            <td style="margin:0;padding:0;font-size:13px;color:#fff;font-family:Roboto,Geneva,sans-serif;font-weight:bold;line-height: 18px;padding-bottom:5px;padding-top:5px;background:#8fbdfd;white-space: nowrap;">{{ numberFormat($subTotal + $shipFee) }}</td>
        </tr>
    </table>
@stop