<?php


	namespace app\modules\services\models;


	use yii\base\Model;

	class OrderService extends Model
	{
		/**
		 * @param Service $service Услуга
		 * @param int $qty Количество услуг
		 */
		public function addServiceToOrder(Service $service, int $qty = 1)
		{


			if (isset($_SESSION['order'][$service->id])) {
				$_SESSION['order'][$service->id]['qty'] += $qty;
			} else {
				$_SESSION['order'][$service->id] = [
					'qty' => $qty,
					'name' => $service->name,
					'price' => $service->price,
					'img' => $service->link_foto_video_file ?
						$service->link_foto_video_file :
						'no-image.png',

				];
			}
			$_SESSION['order.qty'] = isset($_SESSION['order.qty']) ?
				$_SESSION['order.qty'] + $qty : $qty;
			$_SESSION['order.sum'] = isset($_SESSION['order.sum']) ?
				$_SESSION['order.sum'] + $service->price * $qty : $qty * $service->price;

		}

		public function recalc($id)
		{
			$id = (int)$id;

			if (!isset($_SESSION['order'][$id])) return false;
			$qtyMinus = $_SESSION['order'][$id]['qty'];
			$sumMinus = $_SESSION['order'][$id]['qty'] *
				$_SESSION['order'][$id]['price'];
			$_SESSION['order.qty'] -= $qtyMinus;
			$_SESSION['order.sum'] -= $sumMinus;
			unset($_SESSION['order'][$id]);
		}

	}