import '../css/app.css';

import Chart from 'chart.js/auto';
window.Chart = Chart;

import Alpine from 'alpinejs';
import Collapse from '@alpinejs/collapse';

Alpine.plugin(Collapse);
window.Alpine = Alpine;
Alpine.start();

/*==========================================================
SIDEBAR
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const toggle=document.querySelector(".menu-toggle");
const sidebar=document.querySelector(".sidebar");
const overlay=document.querySelector(".sidebar-overlay");

if(toggle&&sidebar&&overlay){

toggle.addEventListener("click",()=>{

sidebar.classList.toggle("show");
overlay.classList.toggle("show");

});

overlay.addEventListener("click",()=>{

sidebar.classList.remove("show");
overlay.classList.remove("show");

});

}

});

/*==========================================================
USER DROPDOWN
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const button=document.getElementById("userDropdown");
const menu=document.getElementById("userMenu");

if(button&&menu){

button.addEventListener("click",(e)=>{

e.stopPropagation();

menu.classList.toggle("show");

});

document.addEventListener("click",()=>{

menu.classList.remove("show");

});

}

});

/*==========================================================
NAVBAR SCROLL
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const navbar=document.querySelector(".navbar-public");

if(!navbar) return;

window.addEventListener("scroll",()=>{

if(window.scrollY>40){

navbar.classList.add("scrolled");

}else{

navbar.classList.remove("scrolled");

}

});

});

/*==========================================================
SMOOTH SCROLL
==========================================================*/

document.querySelectorAll('a[href^="#"]').forEach(anchor=>{

anchor.addEventListener("click",function(e){

const target=document.querySelector(this.getAttribute("href"));

if(target){

e.preventDefault();

window.scrollTo({

top:target.offsetTop-80,

behavior:"smooth"

});

}

});

});

/*==========================================================
FADE UP ANIMATION
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const items=document.querySelectorAll(".fade-up");

const observer=new IntersectionObserver((entries)=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

entry.target.classList.add("show");

observer.unobserve(entry.target);

}

});

},{
threshold:.15
});

items.forEach(item=>observer.observe(item));

});

/*==========================================================
COUNTER ANIMATION
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const numbers=document.querySelectorAll(".stat-content h2,.hero-stat h3");

const observer=new IntersectionObserver((entries)=>{

entries.forEach(entry=>{

if(!entry.isIntersecting) return;

const el=entry.target;

const target=parseInt(el.innerText.replace(/,/g,''))||0;

let current=0;

const step=Math.max(1,Math.ceil(target/80));

const timer=setInterval(()=>{

current+=step;

if(current>=target){

current=target;

clearInterval(timer);

}

el.innerText=current.toLocaleString("id-ID");

},18);

observer.unobserve(el);

});

},{
threshold:.5
});

numbers.forEach(number=>observer.observe(number));

});

/*==========================================================
ACTIVE MENU
==========================================================*/

document.addEventListener("DOMContentLoaded",()=>{

const sections=document.querySelectorAll("section[id]");
const navLinks=document.querySelectorAll(".navbar-public .nav-link");

window.addEventListener("scroll",()=>{

let current="";

sections.forEach(section=>{

const top=section.offsetTop-130;
const height=section.offsetHeight;

if(window.pageYOffset>=top){

current=section.getAttribute("id");

}

});

navLinks.forEach(link=>{

link.classList.remove("active");

const href=link.getAttribute("href");

if(href==="#"+current){

link.classList.add("active");

}

});

});

});

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded",()=>{

const back=document.getElementById("backToTop");

window.addEventListener("scroll",()=>{

if(window.scrollY>350){

back?.classList.add("show");

}else{

back?.classList.remove("show");

}

const winScroll=document.documentElement.scrollTop;

const height=document.documentElement.scrollHeight-document.documentElement.clientHeight;

const scrolled=(winScroll/height)*100;

const progress=document.getElementById("scrollProgress");

if(progress){

progress.style.width=scrolled+"%";

}

});

back?.addEventListener("click",()=>{

window.scrollTo({

top:0,

behavior:"smooth"

});

});

});

const navbar=document.querySelector(".navbar-public");

window.addEventListener("scroll",()=>{

if(window.scrollY>40){

navbar?.classList.add("scrolled");

}else{

navbar?.classList.remove("scrolled");

}

});


/*
|--------------------------------------------------------------------------
| Preloader
|--------------------------------------------------------------------------
*/

window.addEventListener("load",()=>{

const loader=document.getElementById("preloader");

setTimeout(()=>{

loader?.classList.add("hide");

},500);

});

/*
|--------------------------------------------------------------------------
| Active Menu
|--------------------------------------------------------------------------
*/

const sections=document.querySelectorAll("section[id]");

const navLinks=document.querySelectorAll(".navbar-public .nav-link");

window.addEventListener("scroll",()=>{

let current="";

sections.forEach(section=>{

const top=section.offsetTop-120;

const height=section.offsetHeight;

if(scrollY>=top){

current=section.getAttribute("id");

}

});

navLinks.forEach(link=>{

link.classList.remove("active");

if(link.getAttribute("href")==="#"+current){

link.classList.add("active");

}

});

});

