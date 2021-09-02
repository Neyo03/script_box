function openProfil() {
    const suiteBtn = document.querySelectorAll('.contenu-menu-deroulant');

    for (let index = 0; index < suiteBtn.length; index++) {

            if (suiteBtn[0].style.display=='none') {
                suiteBtn[0].style.display='flex';
            }
            else if (suiteBtn[0].style.display=='flex') {
               suiteBtn[0].style.display='none';
            }


    }

    
}
