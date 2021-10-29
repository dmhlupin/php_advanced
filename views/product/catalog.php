<h2>Каталог</h2>
<div class="catalogContainer">
    <?php foreach ($catalog as $item):?>
        <div class="catalogItem">
            <h3><a href="/?c=product&a=card&id=<?=$item['id']?>"><?=$item['name']?></a></h3>
            <img class="catalogImage" src="images/<?=$item['image']?>" alt="image">
            <p>price: <?=$item['price']?></p>
            <button>Купить</button>
        </div>
    <?php endforeach;?>
</div>
