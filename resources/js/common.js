
//function nl2br(str){}ではなく変数の中に関数を入れる
const nl2br = (str) => {
    var res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>");
    return res;
  }
  
  export { nl2br }