/* theme */
const root = document.documentElement;
const themeIcon = document.getElementById("themeIcon");
function applyTheme(t) {
  root.setAttribute("data-theme", t);
  themeIcon.className = t === "dark" ? "fa-solid fa-moon" : "fa-solid fa-sun";
  try {
    localStorage.setItem("novinai-theme", t);
  } catch (e) { }
}
let savedTheme = "dark";
try {
  savedTheme = localStorage.getItem("novinai-theme") || "dark";
} catch (e) { }
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

/* accordion (FAQ) */
document.querySelectorAll(".acc-item").forEach((item) => {
  const btn = item.querySelector(".acc-btn");
  const panelEl = item.querySelector(".acc-panel");
  if (item.classList.contains("open")) {
    panelEl.style.maxHeight = panelEl.scrollHeight + "px";
  }
  btn.addEventListener("click", () => {
    const isOpen = item.classList.contains("open");
    item
      .closest(".acc-list")
      .querySelectorAll(".acc-item")
      .forEach((i) => {
        i.classList.remove("open");
        i.querySelector(".acc-panel").style.maxHeight = null;
      });
    if (!isOpen) {
      item.classList.add("open");
      panelEl.style.maxHeight = panelEl.scrollHeight + "px";
    }
  });
});

/* side quick-nav active state */
const sideLinks = document.querySelectorAll(".side-nav a");
window.addEventListener("scroll", () => {
  let current = "";
  document.querySelectorAll("section[id]").forEach((sec) => {
    if (window.scrollY >= sec.offsetTop - 200) current = sec.getAttribute("id");
  });
  sideLinks.forEach((a) =>
    a.classList.toggle("active", a.getAttribute("href") === "#" + current),
  );
});

/* ---------- process steps: auto-cycle highlight ---------- */
const processSteps = document.querySelectorAll(".process-step");
if (processSteps.length) {
  let stepIndex = 0;
  let cycleTimer = null;

  function highlightStep(i) {
    processSteps.forEach((s) => s.classList.remove("active"));
    processSteps[i].classList.add("active");
  }
  function startCycle() {
    highlightStep(stepIndex);
    cycleTimer = setInterval(() => {
      stepIndex = (stepIndex + 1) % processSteps.length;
      highlightStep(stepIndex);
    }, 2000);
  }
  function stopCycle() {
    clearInterval(cycleTimer);
    processSteps.forEach((s) => s.classList.remove("active"));
  }

  const processIO = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          startCycle();
        } else {
          stopCycle();
        }
      });
    },
    { threshold: 0.4 },
  );
  processIO.observe(document.querySelector(".process-grid"));

  processSteps.forEach((step, i) => {
    step.addEventListener("mouseenter", () => {
      clearInterval(cycleTimer);
      highlightStep(i);
    });
    step.addEventListener("mouseleave", () => {
      stepIndex = i;
      cycleTimer = setInterval(() => {
        stepIndex = (stepIndex + 1) % processSteps.length;
        highlightStep(stepIndex);
      }, 2000);
    });
  });
}

/* ---------- custom combo box: service type ---------- */
const csSelect = document.getElementById("serviceSelect");
const csTrigger = document.getElementById("csTrigger");
const csPanel = document.getElementById("csPanel");
const csLabel = document.getElementById("csLabel");
const serviceInput = document.getElementById("serviceInput");

function closeCombo() {
  csSelect.classList.remove("open");
  csTrigger.setAttribute("aria-expanded", "false");
}
function openCombo() {
  csSelect.classList.add("open");
  csTrigger.setAttribute("aria-expanded", "true");
}
csTrigger.addEventListener("click", (e) => {
  e.stopPropagation();
  csSelect.classList.contains("open") ? closeCombo() : openCombo();
});
csPanel.querySelectorAll(".cs-option").forEach((opt) => {
  opt.addEventListener("click", () => {
    csPanel
      .querySelectorAll(".cs-option")
      .forEach((o) => o.classList.remove("selected"));
    opt.classList.add("selected");
    csLabel.textContent = opt.textContent.trim();
    serviceInput.value = opt.dataset.value;
    csSelect.classList.add("filled");
    csSelect.classList.remove("invalid");
    closeCombo();
  });
});
document.addEventListener("click", (e) => {
  if (!csSelect.contains(e.target)) closeCombo();
});
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") closeCombo();
});

/* ---------- order form submit (front-end only) ---------- */
const orderForm = document.getElementById("orderForm");
const orderSuccess = document.getElementById("orderSuccess");
const orderReset = document.getElementById("orderReset");

orderForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  // اعتبارسنجی سمت کلاینت
  let valid = orderForm.checkValidity();
  if (!serviceInput.value) {
    valid = false;
    csSelect.classList.add("invalid");
    openCombo();
  }
  if (!valid) {
    orderForm.reportValidity();
    return;
  }

  // غیرفعال کردن دکمه در حین ارسال
  const submitBtn = document.getElementById("orderSubmit");
  const originalText = submitBtn.innerHTML;
  submitBtn.disabled = true;
  submitBtn.innerHTML = 'در حال ارسال... <i class="fa-solid fa-spinner fa-spin"></i>';

  try {
    const formData = new FormData(orderForm);

    const response = await fetch(orderForm.action, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: formData,
    });

    // ابتدا به‌صورت متن بگیر تا اگر JSON نبود خطا ندهد
    const rawText = await response.text();
    let data = {};

    try {
      data = JSON.parse(rawText);
    } catch (parseErr) {
      console.error("پاسخ سرور JSON نیست:", rawText);
      alert("پاسخ سرور نامعتبر است. لطفاً با مدیر تماس بگیرید.");
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
      return;
    }

    if (!response.ok) {
      // خطاهای اعتبارسنجی Laravel
      if (data.errors) {
        const first = Object.values(data.errors)[0];
        alert(first[0] || "خطا در ارسال فرم");
      } else {
        alert(data.message || "خطا در ارسال فرم");
      }
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
      return;
    }

    // موفقیت
    orderForm.style.display = "none";
    orderSuccess.classList.add("show");

  } catch (err) {
    console.error("خطای Fetch:", err);
    alert("خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.");
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalText;
  }
}); 
orderReset.addEventListener("click", () => {
  orderForm.reset();
  csLabel.textContent = "خدمت مدنظرتان را انتخاب کنید";
  serviceInput.value = "";
  csSelect.classList.remove("filled", "invalid");
  csPanel
    .querySelectorAll(".cs-option")
    .forEach((o) => o.classList.remove("selected"));
  orderSuccess.classList.remove("show");
  orderForm.style.display = "";
});

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
      "a, button, input, textarea, select, .cs-option, .theme-switch, .order-perk",
    )
    .forEach((el) => {
      el.addEventListener("mouseenter", () => ring.classList.add("hover"));
      el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
    });
}
