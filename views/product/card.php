<h2>Товар</h2>

<div class="cardBlock">
    <div class="cardDescBlock">
        <h3><?=$product->name?></h3>
        <p>Описание: <?=$product->description?></p>
        <p>Цена: <?=$product->price?></p>
        <button>Купить</button>
    </div>
    <div class="cardImgBlock">
        <img class="cardImage" src="images/<?=$product->image?>" alt="img">
    </div>
</div>