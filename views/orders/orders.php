<h2>Заказы</h2>
<div class="ordersContainer">
    <?php foreach ($orders as $item):?>
        <div class="ordersItem">
            <p>id: <?=$item['id']?></p>
            <p>Номер: <?=$item['name']?></p>
            <p>Телефон: <?=$item['phone']?></p>
            <p>Клиент: <?=$item['user_id']?></p>
            <p>Статус: <?=$item['status']?></p>
            <p>Сумма: <?=$item['sum']?></p>
            <p><a href="/?c=orders&a=order&id=<?=$item['id']?>">Посмотреть</a></p>
        </div>
    <?php endforeach;?>
</div>