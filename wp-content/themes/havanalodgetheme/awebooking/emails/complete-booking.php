<div style="border-bottom: 1px solid #e4e4e4; padding: 20px 20px 15px;" >
	
	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Order ID', 'awebooking' ); ?></h6>
	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;">#<?php echo $customerInfo['orderId'] ?>
	</span>

	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Customer name', 'awebooking' ); ?>
	</h6>

	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;"><?php echo $customerInfo['customerName']  ?></span>

	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
		<?php esc_html_e( 'Check in', 'awebooking' ); ?>
	</h6>
	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;"><?php echo date_i18n( $help->getCurrentDateFormat(), strtotime( $orderInfo[0]['checkin'] ) ) ?></span>

	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
		<?php esc_html_e( 'Check out', 'awebooking' ); ?>
	</h6>
	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;"><?php echo date_i18n( $help->getCurrentDateFormat(), strtotime( $orderInfo[0]['checkout'] ) ) ?></span>
</div>
<div style="padding: 20px 20px 15px;">
	<?php 
		$totalPrice = 0;
		$numberRoom = 1; foreach ($orderInfo as $order): 
		$totalPrice += $order['totalPrice'];
	?>
	<h6 style="color: #333333; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;padding-top: 15px;text-align: center;">
		<?php printf( esc_html__( 'Room %s', 'awebooking' ), absint(  $numberRoom++ ) ); ?>
	</h6>
	<div>
		<h3 style="color: #1e63a0; display: block; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: center;"><?php esc_html_e( $order['roomTypeName'] ) ?></h3>
	</div>

	<div style="margin-top: 15px; padding-top: 5px;">
		
		<!-- PRICE BY NIGHT -->
		<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
			<?php esc_html_e( 'Price/Night', 'awebooking' ); ?>
		</h6>
		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<?php 
				$priceByDay = $pr->getPriceRoomByDay(
									$order['roomTypeId'], 
									array(
										'startDate' => $order['checkin'],
										'endDate' 	=> $order['checkout'],
									)
								); 
			?>
			<?php 
			foreach ( $priceByDay as $monthKey => $argsDays ) :  
				$year  = date('Y', strtotime( $monthKey . '-01' ));
				$month = date('m', strtotime( $monthKey . '-01' ));
				foreach ($argsDays as $day => $price):
					$dayFix = str_replace( 'd', '', $day );
					$dayFix = date_i18n( $help->getCurrentDateFormat(), strtotime( $year . '-' . $month . '-' . $dayFix ) );
			?>
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<span><?php echo esc_html( $dayFix ) ?></span><span style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo esc_html( $pr->formatPrice( $price ) )  ?></span>
			</li>
			<?php endforeach; endforeach; ?>
		</ul>
		<!-- END PRICE BY NIGHT -->

		<!-- PRICE BY EXTRA PERSON -->
		<?php if( !empty( $order['price']['extraPerson'] ) ) : ?>
		<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
			<?php esc_html_e( 'Extra price', 'awebooking' ); ?>	
		</h6>
		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<?php if( 0 != $order['price']['extraPerson']['adult'] ): ?>
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<span><?php printf( esc_html__( '%s Adult', 'awebooking' ), absint( 2 ) ); ?>
				</span><span style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo esc_html( $pr->formatPrice( $order['price']['extraPerson']['adult'] ) ) ?></span>
			</li>
			<?php endif; ?>
			<?php if( 0 != $order['price']['extraPerson']['child'] ): ?>
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<span><?php printf( esc_html__( '%s Child', 'awebooking' ), absint( 2 ) ); ?>
				</span><span style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo esc_html( $pr->formatPrice( $order['price']['extraPerson']['child'] ) ) ?></span>
			</li>
			<?php endif; ?>

		</ul>
		<?php endif; ?>
		<!-- END PRICE BY EXTRA PERSON -->

		<!-- PRICE BY SERVICE -->
		<?php if( !empty( $order['price']['services'] ) ) : ?>
		
		<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Package', 'awebooking' ); ?></h6>
		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<?php foreach ( $order['price']['services'] as $services ) : ?>
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<span><?php echo esc_html( $services['serviceName'] ) ?></span><span style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo esc_html( $pr->formatPrice( $services['totalPriceService'] ) ) ?>
				</span>
			</li>
			<?php  endforeach; ?>
		</ul>
		<?php endif; ?>
		<!-- END PRICE BY SERVICE -->
		
		<!-- PRICE BY DISCOUNT -->
		<?php 
		if( !empty( $order['price']['discounts'] ) ) : 
			$discountPlus = array();
			foreach ( $order['price']['discounts'] as $discount ) {
				switch ($discount['sale_type']) {
					case 'sub':
						$discountPlus[] = $pr->formatPrice( $discount['amount'] );
						break;
					case 'decrease':
						$discountPlus[] = $discount['amount']. '%';
						break;
				}
				
			}
		?>
		<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Sale', 'awebooking' ); ?></h6>
		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<span><?php esc_html_e( 'Sale', 'awebooking' ); ?></span><span style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo implode(' + ', $discountPlus); ?>
				</span>
			</li>
		</ul>
		<?php endif; ?>
		<!-- END PRICE BY DISCOUNT -->

	</div>

	<div style="color:#333333;font-size:14px;font-weight:bold;border-bottom: 1px solid #e4e4e4;">
		<p>
		<?php esc_html_e( 'Subtotal', 'awebooking' ); ?>
		<span style="color:#46598b;float:right;font-weight:bold;"><?php echo esc_html( $pr->formatPrice( $order['totalPrice'] ) ) ?></span>
		</p>
	</div>
	<?php endforeach; ?>

</div>

<div style="border-bottom: 1px solid #e4e4e4; padding: 20px 20px 15px;">
	<?php if( !empty( $apbSettings['general_tax_type'] ) ): ?>
	<div  style="color:#333333;font-size:14px;font-weight:bold;padding-top: 15px;">
		<?php esc_html_e( 'Taxes', 'awebooking' ); ?>
		<span style="color:#46598b;float:right;font-weight:bold;"><?php echo esc_html( $pr->formatPrice( $pr->getDisplayTax( $totalPrice ) ) );  ?></span>
	</div>
	<?php endif; ?>
	<div style="color:#333333;font-size:14px;font-weight:bold;padding-top: 15px;">
		<?php esc_html_e( 'Total', 'awebooking' ); ?>
		<span  style="color:#46598b;float:right;font-weight:bold;"><?php echo esc_html( $pr->formatPrice( $pr->calculateTax( $totalPrice ) ) )  ?></span>
	</div>
</div>
