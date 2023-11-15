function randomNum(min, max){
    let numRandom = Math.random();
    let result = Math.floor(numRandom*(max-min)+min);
    return result;
}
function popUpSorteo(){
    let params = 'width=300,height=190,left=800,top=150';
    if (randomNum(1,4)==1){
        window.open('popUpBombones.php', 'sorteo', params);
    }else if (randomNum(1,4)==2){   
        window.open('popUpPatin.php', 'sorteo', params);
    }else if (randomNum(1,4)==3){
        window.open('popUpVale.php', 'sorteo', params);
    }
}
