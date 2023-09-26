function popUpSorteo(){
    let params = 'widht=660,height=300,left=300,top=300';
    if (randomNum(1,4)==1){
        window.open('popUpBombones.php', 'sorteo', params);
    }else if (randomNum(1,4)==2){   
        window.open('popUpPatin.php', 'sorteo', params);
    }else if (randomNum(1,4)==3){
        window.open('popUpVale.php', 'sorteo', params);
    }
}
function randomNum(min, max){
    let numRandom = Math.random();
    let result = Math.floor(numRandom*(max-min)+min);
    return result;
}
