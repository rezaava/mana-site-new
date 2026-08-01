const faDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
function toFa(n) {
  return String(n).replace(/[0-9]/g, (d) => faDigits[d]);
}

/* theme */
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

/* header scroll + progress */
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

/* mobile menu */
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

/* reveal */
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

/* filter tabs */
const filterTabs = document.querySelectorAll(".filter-tab");
const artCards = document.querySelectorAll(".art-card");
const filterCount = document.getElementById("filterCount");
const searchInput = document.getElementById("searchInput");
let currentCat = "all";

function applyFilters() {
  const q = (searchInput.value || "").trim();
  let visible = 0;
  artCards.forEach((card) => {
    const matchesCat = currentCat === "all" || card.dataset.cat === currentCat;
    const matchesSearch = !q || card.dataset.title.indexOf(q) !== -1;
    const show = matchesCat && matchesSearch;
    card.classList.toggle("hidden", !show);
    if (show) visible++;
  });
  filterCount.textContent = toFa(visible) + " مقاله";
}
filterTabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    filterTabs.forEach((t) => t.classList.remove("active"));
    tab.classList.add("active");
    currentCat = tab.dataset.cat;
    applyFilters();
  });
});
searchInput.addEventListener("input", applyFilters);
applyFilters();

/* load more (demo behavior) */
const loadMoreBtn = document.getElementById("loadMoreBtn");
loadMoreBtn.addEventListener("click", (e) => {
  e.preventDefault();
  loadMoreBtn.innerHTML =
    '<i class="fa-solid fa-check"></i> همه مقالات نمایش داده شد';
  loadMoreBtn.style.pointerEvents = "none";
  loadMoreBtn.style.opacity = ".7";
});

/* cute custom cursor */
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
      "a, button, .art-card, .filter-tab, input, textarea, .theme-switch",
    )
    .forEach((el) => {
      el.addEventListener("mouseenter", () => ring.classList.add("hover"));
      el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
    });
}
