<div class="blocPagination">
    <?php   
        if ($pagination>1) {
    ?>
            <form action="./forum" method="POST">
                <input type="hidden" name="pagination" value="<?= $pagination-1?>">
                <button name="">Précédent</button>
            </form>
    <?php
    
        }
        else {
        ?>
            <form method="POST">
                <button name="">Précédent</button>
            </form>
        <?php
        }
        
    ?>
    <form action="./forum" method="POST">
        <input type="hidden" name="pagination" value="<?=$pagination+1?>">
        <button name="">Suivant</button>
    </form>
</div>