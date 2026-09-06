const faDigits=["۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"];
function toFa(n){return String(n).replace(/[0-9]/g,d=>faDigits[d]);}
const root=document.documentElement;
const themeIcon=document.getElementById("themeIcon");
function applyTheme(t){
root.setAttribute("data-theme",t);
if(themeIcon)themeIcon.className=t==="dark"?"fa-solid fa-moon":"fa-solid fa-sun";
try{localStorage.setItem("novinai-theme",t)}catch(e){}
}
let savedTheme="dark";
try{savedTheme=localStorage.getItem("novinai-theme")||"dark"}catch(e){}
applyTheme(savedTheme);
function toggleTheme(){
applyTheme(root.getAttribute("data-theme")==="dark"?"light":"dark");
}
const themeSwitch=document.getElementById("themeSwitch");
const themeSwitchMobile=document.getElementById("themeSwitchMobile");
if(themeSwitch)themeSwitch.addEventListener("click",toggleTheme);
if(themeSwitchMobile)themeSwitchMobile.addEventListener("click",toggleTheme);
const header=document.getElementById("siteHeader");
const toTop=document.getElementById("toTop");
const scrollProgress=document.getElementById("scrollProgress");
window.addEventListener("scroll",()=>{
if(header)header.classList.toggle("scrolled",window.scrollY>40);
if(toTop)toTop.classList.toggle("show",window.scrollY>600);
if(scrollProgress){
const h=document.documentElement;
const max=h.scrollHeight-h.clientHeight;
const pct=max>0?(h.scrollTop/max)*100:0;
scrollProgress.style.setProperty("--sp",pct+"%");
}
});
if(toTop)toTop.addEventListener("click",()=>window.scrollTo({top:0,behavior:"smooth"}));
const panel=document.getElementById("mnavPanel");
const backdrop=document.getElementById("mnavBackdrop");
function openMenu(){
if(panel)panel.classList.add("open");
if(backdrop)backdrop.classList.add("show");
}
function closeMenu(){
if(panel)panel.classList.remove("open");
if(backdrop)backdrop.classList.remove("show");
}
const burgerBtn=document.getElementById("burgerBtn");
const closeDrawer=document.getElementById("closeDrawer");
if(burgerBtn)burgerBtn.addEventListener("click",openMenu);
if(closeDrawer)closeDrawer.addEventListener("click",closeMenu);
if(backdrop)backdrop.addEventListener("click",closeMenu);
if(panel){
panel.querySelectorAll("[data-close]").forEach(el=>el.addEventListener("click",closeMenu));
}
const navLinks=document.querySelectorAll(".main-nav a");
window.addEventListener("scroll",()=>{
let current="";
document.querySelectorAll("section[id],.hero[id]").forEach(sec=>{
if(window.scrollY>=sec.offsetTop-140)current=sec.getAttribute("id");
});
navLinks.forEach(a=>a.classList.toggle("active",a.getAttribute("href")==="#"+current));
});
const revealEls=document.querySelectorAll(".reveal");
if("IntersectionObserver" in window){
const io=new IntersectionObserver(entries=>{
entries.forEach(e=>{
if(e.isIntersecting){
e.target.classList.add("in");
io.unobserve(e.target);
}
});
},{threshold:.15});
revealEls.forEach(el=>io.observe(el));
}else{
revealEls.forEach(el=>el.classList.add("in"));
}
document.querySelectorAll(".svc-card").forEach(card=>{
card.addEventListener("mousemove",e=>{
const r=card.getBoundingClientRect();
card.style.setProperty("--mx",e.clientX-r.left+"px");
card.style.setProperty("--my",e.clientY-r.top+"px");
});
});
document.querySelectorAll(".acc-item").forEach(item=>{
const btn=item.querySelector(".acc-btn");
const panelEl=item.querySelector(".acc-panel");
if(!btn||!panelEl)return;
if(item.classList.contains("open"))panelEl.style.maxHeight=panelEl.scrollHeight+"px";
btn.addEventListener("click",()=>{
const isOpen=item.classList.contains("open");
document.querySelectorAll(".acc-item").forEach(i=>{
i.classList.remove("open");
const p=i.querySelector(".acc-panel");
if(p)p.style.maxHeight=null;
});
if(!isOpen){
item.classList.add("open");
panelEl.style.maxHeight=panelEl.scrollHeight+"px";
}
});
});
function animateCounter(el){
const target=+el.dataset.target;
const dur=1600;
const start=performance.now();
function step(now){
const p=Math.min((now-start)/dur,1);
const eased=1-Math.pow(1-p,3);
el.textContent=toFa(Math.round(eased*target));
if(p<1)requestAnimationFrame(step);
}
requestAnimationFrame(step);
}
const statStrip=document.querySelector(".stat-strip");
if(statStrip&&"IntersectionObserver" in window){
const cio=new IntersectionObserver(entries=>{
entries.forEach(e=>{
if(e.isIntersecting){
document.querySelectorAll(".count-num").forEach(animateCounter);
cio.unobserve(e.target);
}
});
},{threshold:.4});
cio.observe(statStrip);
}
const folioTabs=document.getElementById("folioTabs");
const folioMobileTabs=document.getElementById("folioMobileTabs");
const fpBg=document.getElementById("fpBg");
const fpContent=document.getElementById("fpContent");
const fpDots=document.getElementById("fpDots");
const tabData=[];
function setFolio(i){
const tabs=folioTabs?folioTabs.children:[];
const chips=folioMobileTabs?folioMobileTabs.children:[];
const dots=fpDots?fpDots.children:[];
const tab=tabData[i];
if(!tab)return;
if(fpContent){
fpContent.style.opacity=0;
fpContent.style.transform="translateY(10px)";
}
if(fpBg)fpBg.style.opacity=0;
setTimeout(()=>{
if(fpBg)fpBg.style.background=`linear-gradient(150deg,${tab.from},${tab.to})`;
if(fpContent){
fpContent.innerHTML=`<span class="tag">${tab.tag}</span><h4>${tab.title}</h4><p>${tab.desc}</p><a href="${tab.url}" class="pill">مشاهده جزئیات <i class="fa-solid fa-arrow-up-left"></i></a>`;
fpContent.style.opacity=1;
fpContent.style.transform="translateY(0)";
}
if(fpBg)fpBg.style.opacity=1;
},220);
[...tabs].forEach((el,index)=>el.classList.toggle("active",index===i));
[...chips].forEach((el,index)=>el.classList.toggle("active",index===i));
[...dots].forEach((el,index)=>el.classList.toggle("active",index===i));
}
if(folioTabs){
[...folioTabs.children].forEach((tab,index)=>{
const title=tab.querySelector("h5")?.textContent.trim()||"";
const tag=tab.querySelector("span")?.textContent.trim()||"";
const icon=tab.querySelector("i")?.className||"";
const projectId=tab.dataset.project||tab.dataset.index;
tabData.push({
title:title,
tag:tag,
desc:tab.dataset.description||"",
from:tab.dataset.from||"#1d2a6b",
to:tab.dataset.to||"#0b1030",
url:tab.dataset.url||"#",
icon:icon,
id:projectId
});
tab.addEventListener("click",()=>setFolio(index));
});
}
if(folioMobileTabs){
[...folioMobileTabs.children].forEach((chip,index)=>{
chip.addEventListener("click",()=>setFolio(index));
});
}
if(fpDots){
[...fpDots.children].forEach((dot,index)=>{
dot.addEventListener("click",()=>setFolio(index));
});
}
if(tabData.length>0)setFolio(0);
if(window.matchMedia("(pointer:fine)").matches){
document.body.classList.add("has-cursor");
const dot=document.getElementById("curDot");
const ring=document.getElementById("curRing");
if(dot&&ring){
let mx=0,my=0,rx=0,ry=0;
window.addEventListener("mousemove",e=>{
mx=e.clientX;
my=e.clientY;
dot.style.transform=`translate(${mx}px,${my}px) translate(-50%,-50%)`;
});
function loop(){
rx+=(mx-rx)*.16;
ry+=(my-ry)*.16;
ring.style.transform=`translate(${rx}px,${ry}px) translate(-50%,-50%)`;
requestAnimationFrame(loop);
}
loop();
document.querySelectorAll("a,button,.svc-card,.folio-tab,.team-card,input,textarea,.theme-switch,.mnav-panel nav a,.chat-fab,.fmt-chip").forEach(el=>{
el.addEventListener("mouseenter",()=>ring.classList.add("hover"));
el.addEventListener("mouseleave",()=>ring.classList.remove("hover"));
});
}
}
