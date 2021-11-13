<h2>Корзина</h2>
<div class="catalogContainer">
    <?php foreach ($basket as $item):?>
        <div class="catalogItem">
            <h3><?=$item['name']?></h3>
            <img class="catalogImage" src="images/<?=$item['image']?>" alt="image">
            <p>price: <?=$item['price']?></p>
            <button>Удалить</button>
        </div>
    <?php endforeach;?>
</div>