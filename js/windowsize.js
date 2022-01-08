function addDiv()
{
  let windowSize = document.createElement("div");
  let body = document.querySelector("body");
  windowSize.style.color = "red";
  windowSize.style.position = "absolute";
  windowSize.style.top = "0px";
  windowSize.style.left = "0px";
  windowSize.id = "ws";
  body.appendChild(windowSize);
};
addDiv();
window.addEventListener("resize", function(){
  document.getElementById("ws").innerText = 'WIDTH: ' + window.innerWidth + ' HEIGHT: ' + window.innerHeight;
});