function addDiv()
{
  let windowSize = document.createElement("div");
  let body = document.querySelector("body");
  windowSize.style.color = "red";
  windowSize.style.position = "absolute";
  windowSize.style.top = "5px";
  windowSize.style.left = "5px";
  windowSize.id = "ws";
  body.appendChild(windowSize);

  let para = document.createElement("p");
  para.id = "para";
  windowSize.appendChild(para);
};
addDiv();
window.addEventListener("resize", function(){
  document.getElementById("para").innerText = 'WIDTH: ' + window.innerWidth + ' HEIGHT: ' + window.innerHeight;
});