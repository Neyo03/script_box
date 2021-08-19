<div class="blocAllTrophe">

    <?php foreach ($listeTrophe as $trophe):?>
        <div class="blocTrophe">

            <img src="../../views/img/trophe/<?= $trophe->getImage(); ?>" alt="">
            <h3><?= $trophe->getNom(); ?></h3>
            <p>Bravo, tu as <?= $trophe->getDescription(); ?></p>
            
        </div>



       





    <?php endforeach?>
</div>

   









