<b>Новый заказ #{$order.num}</b> FF
на сумму {$order.cost} руб. FF
-------------------------------------- FF
Способ доставки: {$delivery.name} FF
Способ оплаты: {$payment.name} FF
-------------------------------------- FF
<b>Данные доставки:</b> FF
Имя: {$address.receiver} FF
Телефон: {$address.phone} FF
Email: {$user_profile.email} FF
Комментарий: {$address.comment} FF
-------------------------------------- FF
<b>Товары:</b> FF
{foreach $products as $product index=$index}
    {$index+1}. {$product.name} ({$product.count} шт.) - {$product.price} руб. FF
{/foreach}