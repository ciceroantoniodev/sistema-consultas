/*
========================================
 Cross Frame Popup Menus v1.0.1
 Add-on for SmartMenus v6.0.2+
========================================
 (c)2008 ET VADIKOM-VASIL DINKOV
========================================
*/


c_mainFrameName='main'; // the name of the frame containing your menus
c_mainFramePosition=1; // 1- bottom, 2- right, 3- top, 4- left


// ===
function c_show(m,e){var f=parent.frames[c_mainFrameName];if(!f||typeof f.c_show=="undefined")return;var u=f.c_gO(m);if(!u||u.IN!=2)return;if(typeof c_dB=="undefined"){c_dB=document.getElementsByTagName("body")[0];c_dE=document.documentElement||""}var c,x,y,sX,sY,eX,eY,D;c=f.c_gW();D=f.c_qM?c_dB:c_dE;sX=window.pageXOffset||D.scrollLeft||0;sY=window.pageYOffset||D.scrollTop||0;eX=e?e.pageX||e.clientX+sX:0;eY=e?e.pageY||e.clientY+sY:0;x=arguments[2]?arguments[2].replace(/mouseX/g,eX).replace(/mouseY/g,eY):eX;y=arguments[3]?arguments[3].replace(/mouseX/g,eX).replace(/mouseY/g,eY):eY;if(c_mainFramePosition==1||c_mainFramePosition==2){x+="+"+c.x;y+="+"+c.y}else if(c_mainFramePosition==3){x+="+"+c.x;y=c.h+c.y+"-menuH"+"-("+y+")"}else if(c_mainFramePosition==4){x=c.w+c.x+"-menuW"+"-("+x+")";y+="+"+c.y}f.c_show(m,e,x,y)};function c_hide(){var f=parent.frames[c_mainFrameName];if(!f||typeof f.c_hide=="undefined")return;f.c_hide()}