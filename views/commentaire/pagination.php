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
            <form style="visibility: hidden;" method="POST">
                <button name="">Précédent</button>
            </form>
        <?php
        }
        if ($pagination < $maxPage) {
    ?>
        <form action="./forum" method="POST">
            <input type="hidden" name="pagination" value="<?=$pagination+1?>">
            <button name="">Suivant</button>
        </form>
    <?php
        } 
    ?>  
</div>