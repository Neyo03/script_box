<div class="blocPagination">
    <?php   
        if ($pagination>1) {
    ?>
            <form action="" method="POST">
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
        if ($pagination>1) {
            ?>
                <form action="" method="post">
                    <input type="hidden" name="pagination" value="<?=1?>">
                    <button type="submit"><<</button>
                </form>
            <?php
        }
        $page=1;

        if ($pagination<=2 AND $maxPage>2) {
            $page=1;
        }
        elseif ($pagination<=2 AND $maxPage<=2) {
            $page=$maxPage-1;
        }
        elseif ($pagination<=$maxPage) {
            $page=$maxPage-2;
        }
        if ($pagination<=2 AND $maxPage<=2) {
            for($i=$page;$i<=$page+1;$i++) { 
                ?>
                    <form action="" method="post">
                        <input type="hidden" name="pagination" value="<?=$i?>">
                        <button type="submit"><?= $i?></button>
                    </form>
                <?php
            }
        }
        else {
            for($i=$page;$i<=$page+2;$i++) { 
                ?>
                    <form action="" method="post">
                        <input type="hidden" name="pagination" value="<?=$i?>">
                        <button type="submit"><?= $i?></button>
                    </form>
                <?php
            }
        }

        if ($maxPage>3 AND $pagination<$maxPage) {
        ?>
            <form action="" method="post">
                    <input type="hidden" name="pagination" value="<?=$maxPage?>">
                    <button type="submit">>></button>
                </form>
        <?php
        }
        if ($pagination < $maxPage) {
    ?>
        <form action="" method="POST">
            <input type="hidden" name="pagination" value="<?=$pagination+1?>">
            <button name="">Suivant</button>
        </form>
    <?php
        } 
        else {
        ?>
        <form style="visibility: hidden;" method="POST">
            <button name="">Suivant</button>
        </form>
        <?php
        }
    ?>  
</div>