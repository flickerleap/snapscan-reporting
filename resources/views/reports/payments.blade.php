@if(!empty($payments))
        
    <?php $totalAmount = $totalFee = $totalSettle = $totalValid = $count = 0;?>

    @foreach ($payments as $payment)
        <?php if ($payment->status == 'completed') :?>
            <?php $count++;?>
            <?php $totalValid += $payment->totalAmount;?>
        <?php endif;?>
        <?php $totalAmount += $payment->totalAmount;?>
        <?php $totalFee += $payment->feeAmount;?>
        <?php $totalSettle += $payment->settleAmount;?>
    @endforeach

    <p>
        Total value of <strong>valid</strong> transactions: <?php echo 'R ' . number_format($totalValid/100, 2, '.', ','); ?> (<?php echo 'R ' . number_format(($totalAmount - $totalValid) /100, 2, '.', ','); ?> failed)<br />
        Total number of <strong>valid</strong> transactions: <?php echo $count;?> (<?php echo count($payments) - $count; ?> failed)
    </p> 
    <table class="table table-striped table-hover table-condensed">
    <thead>
        <tr>
                <th></th>
                <th>Time of Payment</th>
                <th>User Reference</th>
                <th>Amount</th>
                <th>Fee</th>
                <th>Total Settled</th>
                <!--<th class="actions"><?php echo __('Actions'); ?></th>-->
        </tr>
    </thead>
    <tbody>
    @foreach ($payments as $payment)
        <tr>
            <td>
                @if($payment->status == 'completed')
                    <i class="fa fa-check" style="color:rgb(50,200,50);" title="completed"></i>
                @elseif($payment->status == 'error')
                    <i class="fa fa-close" style="color:rgb(200,50,50);" title="error"></i>
                @else
                    <i class="fa fa-warning" style="color:rgb(200,150,100);" title="pending"></i>
                @endif
                <span class="text-muted"><?php echo $payment->id; ?></span>
            </td>
            <td><?php echo date("j M Y H\hi", strtotime($payment->date)); ?>&nbsp;</td>
            <td>{{ $payment->userReference }}</td>
            <td><?php echo 'R ' . number_format($payment->totalAmount/100, 2, '.', ','); ?>&nbsp;</td>
            <td><?php echo 'R ' . number_format($payment->feeAmount/100, 2, '.', ','); ?>&nbsp;</td>
            <td><?php echo 'R ' . number_format($payment->settleAmount/100, 2, '.', ','); ?>&nbsp;</td>
        </tr>
    @endforeach
    </tbody>
        <tfoot>
        <tr>
            <td colspan="4"></td>
            <td><strong><?php echo 'R ' . number_format($totalAmount/100, 2, '.', ','); ?>&nbsp;</strong></td>
            <td><strong><?php echo 'R ' . number_format($totalFee/100, 2, '.', ','); ?>&nbsp;</strong></td>
            <td><strong><?php echo 'R ' . number_format($totalSettle/100, 2, '.', ','); ?>&nbsp;</strong></td>
            <!--<td></td>-->
        </tr>
    </tfoot>
    </table>

@else

    <h2><?php echo __('Payments'); ?></h2>

    <p>No payments found</p>

@endif