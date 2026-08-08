/* ---------- persian digits ---------- */
const faDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
function toFa(n) {
  return String(n).replace(/[0-9]/g, (d) => faDigits[d]);
}

/* ---------- theme ---------- */
const root = document.documentElement;
const themeIcon = document.getElementById("themeIcon");
function applyTheme(t) {
  root.setAttribute("data-theme", t);
  themeIcon.className = t === "dark" ? "fa-solid fa-moon" : "fa-solid fa-sun";
  try {
    localStorage.setItem("novinai-theme", t);
  } catch (e) {}
}
let savedTheme = "dark";
try {
  savedTheme = localStorage.getItem("novinai-theme") || "dark";
} catch (e) {}
applyTheme(savedTheme);
function toggleTheme() {
  applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
}
document.getElementById("themeSwitch").addEventListener("click", toggleTheme);
document
  .getElementById("themeSwitchMobile")
  .addEventListener("click", toggleTheme);

/* ---------- header scroll state + progress bar ---------- */
const header = document.getElementById("siteHeader");
const toTop = document.getElementById("toTop");
const scrollProgress = document.getElementById("scrollProgress");
window.addEventListener("scroll", () => {
  header.classList.toggle("scrolled", window.scrollY > 40);
  toTop.classList.toggle("show", window.scrollY > 600);
  const h = document.documentElement;
  const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
  scrollProgress.style.setProperty("--sp", pct + "%");
});
toTop.addEventListener("click", () =>
  window.scrollTo({ top: 0, behavior: "smooth" }),
);

/* ---------- mobile off-canvas menu ---------- */
const panel = document.getElementById("mnavPanel");
const backdrop = document.getElementById("mnavBackdrop");
function openMenu() {
  panel.classList.add("open");
  backdrop.classList.add("show");
}
function closeMenu() {
  panel.classList.remove("open");
  backdrop.classList.remove("show");
}
document.getElementById("burgerBtn").addEventListener("click", openMenu);
document.getElementById("closeDrawer").addEventListener("click", closeMenu);
backdrop.addEventListener("click", closeMenu);
panel
  .querySelectorAll("[data-close]")
  .forEach((el) => el.addEventListener("click", closeMenu));

/* ---------- active nav link ---------- */
const navLinks = document.querySelectorAll(".main-nav a");
window.addEventListener("scroll", () => {
  let current = "";
  document.querySelectorAll("section[id], .hero[id]").forEach((sec) => {
    if (window.scrollY >= sec.offsetTop - 140) current = sec.getAttribute("id");
  });
  navLinks.forEach((a) =>
    a.classList.toggle("active", a.getAttribute("href") === "#" + current),
  );
});

/* ---------- scroll reveal ---------- */
const revealEls = document.querySelectorAll(".reveal");
const io = new IntersectionObserver(
  (entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.classList.add("in");
        io.unobserve(e.target);
      }
    });
  },
  { threshold: 0.15 },
);
revealEls.forEach((el) => io.observe(el));

/* ---------- service card cursor glow ---------- */
document.querySelectorAll(".svc-card").forEach((card) => {
  card.addEventListener("mousemove", (e) => {
    const r = card.getBoundingClientRect();
    card.style.setProperty("--mx", e.clientX - r.left + "px");
    card.style.setProperty("--my", e.clientY - r.top + "px");
  });
});

/* ---------- accordion ---------- */
document.querySelectorAll(".acc-item").forEach((item) => {
  const btn = item.querySelector(".acc-btn");
  const panelEl = item.querySelector(".acc-panel");
  if (item.classList.contains("open")) {
    panelEl.style.maxHeight = panelEl.scrollHeight + "px";
  }
  btn.addEventListener("click", () => {
    const isOpen = item.classList.contains("open");
    document.querySelectorAll(".acc-item").forEach((i) => {
      i.classList.remove("open");
      i.querySelector(".acc-panel").style.maxHeight = null;
    });
    if (!isOpen) {
      item.classList.add("open");
      panelEl.style.maxHeight = panelEl.scrollHeight + "px";
    }
  });
});

/* ---------- counters 0 -> target ---------- */
function animateCounter(el) {
  const target = +el.dataset.target;
  const dur = 1600;
  const start = performance.now();
  function step(now) {
    const p = Math.min((now - start) / dur, 1);
    const eased = 1 - Math.pow(1 - p, 3);
    el.textContent = toFa(Math.round(eased * target));
    if (p < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}
const statStrip = document.querySelector(".stat-strip");
if (statStrip) {
  const cio = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          document.querySelectorAll(".count-num").forEach(animateCounter);
          cio.unobserve(e.target);
        }
      });
    },
    { threshold: 0.4 },
  );
  cio.observe(statStrip);
}

/* ---------- portfolio switcher ---------- */
const folioData = [
  {
    icon: "fa-gauge-high",
    tag: "پنل مدیریت",
    title: "داشبورد هوشمند فروش",
    desc: "داشبوردی تحلیلی برای رصد لحظه‌ای فروش، موجودی و رفتار مشتریان با گزارش‌های هوشمند.",
    
    from: "#1d2a6b",
    to: "#28300b",
  },
  {
    icon: "fa-gauge-high",
    tag: "پنل مدیریت",
    title: "داشبورد هوشمند فروش",
    desc: "داشبوردی تحلیلی برای رصد لحظه‌ای فروش، موجودی و رفتار مشتریان با گزارش‌های هوشمند.",
    from: "#1d2a6b",
    to: "#0b1030",
  },
  {
    icon: "fa-bag-shopping",
    tag: "فروشگاه آنلاین",
    title: "پلتفرم تجارت الکترونیک",
    desc: "فروشگاهی سریع و مقیاس‌پذیر با تجربه‌ی خرید یکپارچه در وب و موبایل.",
    from: "#0d5c52",
    to: "#07211d",
  },
  {
    icon: "fa-building-columns",
    tag: "اپلیکیشن بانکی",
    title: "اپ موبایل بانکداری نوین",
    desc: "اپلیکیشن بانکی امن با احراز هویت بیومتریک و تجربه‌ی کاربری ساده.",
    from: "#6b2a4a",
    to: "#2b0f1e",
  },
  {
    icon: "fa-graduation-cap",
    tag: "آموزش آنلاین",
    title: "پلتفرم یادگیری هوشمند",
    desc: "سامانه‌ی آموزش آنلاین با مسیرهای یادگیری شخصی‌سازی‌شده توسط هوش مصنوعی.",
    from: "#2f7dfb",
    to: "#0d1030",
  },
  {
    icon: "fa-heart-pulse",
    tag: "سلامت دیجیتال",
    title: "سامانه نوبت‌دهی پزشکی",
    desc: "سامانه‌ای برای نوبت‌دهی، پرونده الکترونیک و مشاوره آنلاین با پزشکان.",
    from: "#17c3b2",
    to: "#08211f",
  },
];
const folioTabs = document.getElementById("folioTabs");
const folioMobileTabs = document.getElementById("folioMobileTabs");
const fpBg = document.getElementById("fpBg");
const fpContent = document.getElementById("fpContent");
const fpDots = document.getElementById("fpDots");

folioData.forEach((d, i) => {
  const tab = document.createElement("div");
  tab.className = "folio-tab" + (i === 0 ? " active" : "");
  tab.innerHTML = `<div class="ft-ic"><i class="fa-solid ${d.icon}"></i></div><div><h5>${d.title}</h5><span>${d.tag}</span></div><div class="bar"></div>`;
  tab.addEventListener("click", () => setFolio(i));
  folioTabs.appendChild(tab);

  const chip = document.createElement("div");
  chip.className = "fmt-chip" + (i === 0 ? " active" : "");
  chip.textContent = d.tag;
  chip.addEventListener("click", () => setFolio(i));
  folioMobileTabs.appendChild(chip);

  const dot = document.createElement("span");
  if (i === 0) dot.className = "active";
  fpDots.appendChild(dot);
});

function setFolio(i) {
  const d = folioData[i];
  fpContent.style.opacity = 0;
  fpContent.style.transform = "translateY(10px)";
  fpBg.style.opacity = 0;
  setTimeout(() => {
    fpBg.style.background = `linear-gradient(150deg, ${d.from}, ${d.to})`;
    fpContent.innerHTML = `<span class="tag">${d.tag}</span><h4>${d.title}</h4><p>${d.desc}</p><a href="/project.html" class="pill">مشاهده جزئیات <i class="fa-solid fa-arrow-up-left"></i></a>`;
    fpBg.style.opacity = 1;
    fpContent.style.opacity = 1;
    fpContent.style.transform = "translateY(0)";
  }, 220);
  [...folioTabs.children].forEach((t, idx) =>
    t.classList.toggle("active", idx === i),
  );
  [...folioMobileTabs.children].forEach((c, idx) =>
    c.classList.toggle("active", idx === i),
  );
  [...fpDots.children].forEach((dt, idx) =>
    dt.classList.toggle("active", idx === i),
  );
}
setFolio(0);

/* ---------- cute custom cursor ---------- */
if (window.matchMedia("(pointer:fine)").matches) {
  document.body.classList.add("has-cursor");
  const dot = document.getElementById("curDot");
  const ring = document.getElementById("curRing");
  let mx = 0,
    my = 0,
    rx = 0,
    ry = 0;
  window.addEventListener("mousemove", (e) => {
    mx = e.clientX;
    my = e.clientY;
    dot.style.transform = `translate(${mx}px,${my}px) translate(-50%,-50%)`;
  });
  function loop() {
    rx += (mx - rx) * 0.16;
    ry += (my - ry) * 0.16;
    ring.style.transform = `translate(${rx}px,${ry}px) translate(-50%,-50%)`;
    requestAnimationFrame(loop);
  }
  loop();
  document
    .querySelectorAll(
      "a, button, .svc-card, .folio-tab, .team-card, input, textarea, .theme-switch, .mnav-panel nav a, .chat-fab, .fmt-chip",
    )
    .forEach((el) => {
      el.addEventListener("mouseenter", () => ring.classList.add("hover"));
      el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
    });
}
