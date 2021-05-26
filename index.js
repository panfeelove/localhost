
link=document.createElement('link');
link.rel='stylesheet';
link.href='darkTheme.css';
link.id='style';
let n = 1;

let arrow = document.getElementById('arrow');
arrow.src='images/arrow-up.png';
function remove(elem) {
    return elem.parentNode ? elem.parentNode.removeChild(elem) : elem;
  }


const darkTheme =()=>{
    if(n === 1){
        document.getElementsByTagName('head')[0].appendChild(link);
        arrow.src='images/arrow-up2.png';
    }else if(n === -1){
        remove(link);
        arrow.src='images/arrow-up.png';
    }
    n*=-1;
}




