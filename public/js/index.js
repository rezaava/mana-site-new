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
  const rawTarget = el.dataset.target || "0";

  const cleanTarget = rawTarget
    .replace(/[۰-۹]/g, d => "۰۱۲۳۴۵۶۷۸۹".indexOf(d))
    .replace(/[٠-٩]/g, d => "٠١٢٣٤٥٦٧٨٩".indexOf(d))
    .replace(/[^\d.-]/g, "");

  const target = parseFloat(cleanTarget) || 0;
  const dur = 1600;
  const start = performance.now();

  function step(now) {
    const p = Math.min((now - start) / dur, 1);
    const eased = 1 - Math.pow(1 - p, 3);

    el.textContent = toFa(Math.round(eased * target));

    if (p < 1) {
      requestAnimationFrame(step);
    }
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
      "a, button, .svc-card, .folio-tab, .team-card, input, textarea, .theme-switch, .mnav-panel nav a, .chat-fab, .fmt-chip, .fmt-btn",
    )
    .forEach((el) => {
      el.addEventListener("mouseenter", () => ring.classList.add("hover"));
      el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
    });
} /* <--- براکت مهم: این باید اینجا بسته می‌شد که در کد شما باز مانده بود */

/* ---------- global english to persian digits converter ---------- */
function convertNodeNumbers(node) {
  if (node.nodeType === Node.TEXT_NODE) {
    if (node.parentNode && !['SCRIPT', 'STYLE', 'TEXTAREA', 'INPUT'].includes(node.parentNode.tagName)) {
      node.nodeValue = toFa(node.nodeValue);
    }
  } else {
    for (let child of node.childNodes) {
      convertNodeNumbers(child);
    }
  }
}

/* ---------- DOMContentLoaded (اجرای کدهای وابسته به رندر صفحه) ---------- */
document.addEventListener("DOMContentLoaded", () => {
  // ۱. اجرای تبدیل اعداد فارسی
  convertNodeNumbers(document.body);
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        convertNodeNumbers(node);
      });
    });
  });
  observer.observe(document.body, {
    childList: true,
    subtree: true
  });

  // ۲. منطق سوئیچ کردن تب‌های پورتفولیو (سازگار با دیتابیس لارول)
  const desktopTabs = document.querySelectorAll('.folio-tab');
  const mobileTabs = document.querySelectorAll('.fmt-btn');
  const projectCards = document.querySelectorAll('.fp-item');
  const dots = document.querySelectorAll('.dot');

  const switchProject = (projectId) => {
    const removeActive = (elements) => {
      elements.forEach(el => el.classList.remove('active'));
    };
    removeActive(desktopTabs);
    removeActive(mobileTabs);
    removeActive(projectCards);
    removeActive(dots);

    const targetDesktopTab = document.querySelector(`.folio-tab[data-project-id="${projectId}"]`);
    const targetMobileTab = document.querySelector(`.fmt-btn[data-project-id="${projectId}"]`);
    const targetCard = document.querySelector(`.fp-item[data-project-id="${projectId}"]`);
    const targetDot = document.querySelector(`.dot[data-project-id="${projectId}"]`);

    if (targetDesktopTab) targetDesktopTab.classList.add('active');
    if (targetMobileTab) targetMobileTab.classList.add('active');
    if (targetCard) targetCard.classList.add('active');
    if (targetDot) targetDot.classList.add('active');
  };

  desktopTabs.forEach(tab => {
    tab.addEventListener('click', function() {
      const projectId = this.getAttribute('data-project-id');
      switchProject(projectId);
    });
  });

  mobileTabs.forEach(tab => {
    tab.addEventListener('click', function() {
      const projectId = this.getAttribute('data-project-id');
      switchProject(projectId);
    });
  });

  dots.forEach(dot => {
    dot.addEventListener('click', function() {
      const projectId = this.getAttribute('data-project-id');
      switchProject(projectId);
    });
  });
});