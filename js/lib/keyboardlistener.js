
//if(document.captureEvents) document.captureEvents(Event.KEYPRESS);

document.onkeypress = KeyCheck;
document.onkeyup = KeyUp;


function KeyCheck(e){
    
   //if(isPreventDefault) {e.preventDefault()};
   var KeyID = (window.event) ? event.keyCode : e.keyCode;

   switch(KeyID){

      case 16:
      document.Form1.KeyName.value = "Shift";
      break;

      case 17:
      ///document.Form1.KeyName.value = "Ctrl";
      break;

      case 18:
      //document.Form1.KeyName.value = "Alt";
      break;

      case 19:
      //document.Form1.KeyName.value = "Pause";
      break;

      case 37:
      keyPressed("left");
      break;

      case 38:
      keyPressed("up");
      break;

      case 39:
      keyPressed("right");
      break;

      case 40:
      keyPressed("down");
      break;

      case 13:
      keyPressed("enter");
      break;
   }

}

//Playground
function KeyUp(e){
    countNr = 0;
}