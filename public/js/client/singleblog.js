// ======================================================
// ===== ثبت بازدید بعد از ۱۰ ثانیه (اول از همه اجرا شود) =====
// ======================================================
(function () {
  function initBlogView() {
    const blogEl = document.querySelector('[data-blog-id]');
    if (!blogEl) {
      console.warn('[view] article با data-blog-id پیدا نشد');
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    const viewRoute = blogEl.dataset.viewUrl;

    console.log('[view] روت:', viewRoute, '| CSRF:', csrfToken ? 'دارد' : 'ندارد');

    if (!viewRoute) return;

    setTimeout(function () {
      console.log('[view] ۱۰ ثانیه گذشت، ارسال درخواست...');

      fetch(viewRoute, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken || '',
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'same-origin',
      })
        .then(async (res) => {
          console.log('[view] status:', res.status);
          const text = await res.text();
          try { return JSON.parse(text); }
          catch (e) { throw new Error('پاسخ JSON نبود: ' + text); }
        })
        .then((data) => {
          if (data && data.ok) {
            const viewSpan = document.querySelector('.view-count');
            if (viewSpan) {
              viewSpan.textContent = Number(data.view).toLocaleString('en-US');
              console.log('[view] آپدیت شد به:', data.view);
            }
          }
        })
        .catch((err) => console.error('[view] خطا:', err));
    }, 10000);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBlogView);
  } else {
    initBlogView();
  }
})();




// ===== theme =====
const root = document.documentElement;
const themeIcon = document.getElementById("themeIcon");
function applyTheme(t) {
  root.setAttribute("data-theme", t);
  if (themeIcon) {
    themeIcon.className = t === "dark" ? "fa-solid fa-moon" : "fa-solid fa-sun";
  }
  try { localStorage.setItem("novinai-theme", t); } catch (e) { }
}
let savedTheme = "dark";
try { savedTheme = localStorage.getItem("novinai-theme") || "dark"; } catch (e) { }
applyTheme(savedTheme);

// ✅ همه getElementById ها با null check
const themeSwitch = document.getElementById("themeSwitch");
if (themeSwitch) {
  themeSwitch.addEventListener("click", () => {
    applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
  });
}

const themeSwitchMobile = document.getElementById("themeSwitchMobile");
if (themeSwitchMobile) {
  themeSwitchMobile.addEventListener("click", () => {
    applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
  });
}

// ===== هدر و اسکرول =====
const header = document.getElementById("siteHeader");
const toTopBtn = document.getElementById("toTop");
const scrollProgress = document.getElementById("scrollProgress");

window.addEventListener("scroll", () => {
  if (header) header.classList.toggle("scrolled", window.scrollY > 40);
  if (toTopBtn) toTopBtn.classList.toggle("show", window.scrollY > 600);
  if (scrollProgress) {
    const h = document.documentElement;
    const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
    scrollProgress.style.setProperty("--sp", pct + "%");
  }
});

if (toTopBtn) {
  toTopBtn.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));
}

// ===== منو موبایل =====
const panel = document.getElementById("mnavPanel");
const backdrop = document.getElementById("mnavBackdrop");
const burgerBtn = document.getElementById("burgerBtn");
const closeDrawer = document.getElementById("closeDrawer");

if (burgerBtn && panel && backdrop) {
  burgerBtn.addEventListener("click", () => {
    panel.classList.add("open");
    backdrop.classList.add("show");
  });
}
if (closeDrawer && panel && backdrop) {
  closeDrawer.addEventListener("click", () => {
    panel.classList.remove("open");
    backdrop.classList.remove("show");
  });
}
if (backdrop && panel) {
  backdrop.addEventListener("click", () => {
    panel.classList.remove("open");
    backdrop.classList.remove("show");
  });
}
if (panel) {
  panel.querySelectorAll("[data-close]").forEach((el) =>
    el.addEventListener("click", () => {
      panel.classList.remove("open");
      if (backdrop) backdrop.classList.remove("show");
    })
  );
}

// ===== ریویل انیمیشن =====
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
  { threshold: 0.03 }
);
revealEls.forEach((el) => io.observe(el));

// ===== لایک =====
const likeBtn = document.getElementById("likeBtn");
if (likeBtn) {
  let liked = false;
  let likeCount = 89;
  likeBtn.addEventListener("click", () => {
    liked = !liked;
    likeCount += liked ? 1 : -1;
    likeBtn.textContent = " " + likeCount;
    likeBtn.style.color = liked ? "var(--accent)" : "var(--text-dim)";
    likeBtn.className = liked ? "fa-solid fa-heart" : "fa-regular fa-heart";
    likeBtn.style.cursor = "pointer";
  });
}

// ===== نظر جدید (AJAX) =====
// ===== نظر جدید (AJAX) =====
document.addEventListener("DOMContentLoaded", function () {
  const commentForm = document.getElementById("commentForm");
  const submitBtn = commentForm?.querySelector('button[type="submit"]');
  const commentList = document.getElementById("commentList");
  const commentCount = document.getElementById("commentCount");

  // جلوگیری از XSS
  function escapeHtml(str) {
    if (!str) return "";
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
  }

  // تبدیل اعداد فارسی/عربی به عدد صحیح
  function parsePersianNumber(str) {
    if (!str) return 0;
    const persianDigits = "۰۱۲۳۴۵۶۷۸۹";
    const arabicDigits = "٠١٢٣٤٥٦٧٨٩";
    const normalized = str
      .replace(/[۰-۹]/g, (d) => persianDigits.indexOf(d))
      .replace(/[٠-٩]/g, (d) => arabicDigits.indexOf(d))
      .replace(/[^0-9]/g, "");
    return parseInt(normalized, 10) || 0;
  }

  if (commentForm && submitBtn && commentList) {
    commentForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const name = document.getElementById("commentName").value.trim();
      const text = document.getElementById("commentText").value.trim();

      if (!name || !text) {
        alert("لطفاً نام و متن نظر را وارد کنید.");
        return;
      }

      submitBtn.disabled = true;
      const originalBtnText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> در حال ارسال...';

      const formData = new FormData(commentForm);
      const csrfMeta = document.querySelector('meta[name="csrf-token"]');

      fetch(commentForm.action, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfMeta ? csrfMeta.content : "",
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: formData,
      })
        .then(async (res) => {
          const data = await res.json().catch(() => null);
          return { status: res.status, data };
        })
        .then(({ status, data }) => {
          // خطای اعتبارسنجی
          if (status === 422 && data && data.errors) {
            const errorMessages = Object.values(data.errors).flat().join("\n");
            alert("خطا در اعتبارسنجی:\n" + errorMessages);
            return;
          }

          if (!data || !data.ok) {
            alert((data && data.message) || "خطا در ثبت نظر");
            return;
          }

          // ── حذف پیام "هنوز نظری ثبت نشده" ──
          const emptyMsg = commentList.querySelector(".comment-item .cbody h6");
          if (emptyMsg && emptyMsg.textContent.includes("هنوز نظری ثبت نشده")) {
            emptyMsg.closest(".comment-item")?.remove();
          }

          // ── افزودن نظر جدید بدون رفرش ──
          const safeName = escapeHtml(name);
          const safeText = escapeHtml(text);
          const initial = escapeHtml(name.charAt(0).toUpperCase());

          const newComment = document.createElement("div");
          newComment.className = "comment-item";
          newComment.style.opacity = "0";
          newComment.style.transform = "translateY(20px)";
          newComment.innerHTML = `
            <div class="cav" style="background: linear-gradient(135deg, var(--brand), var(--accent-2))">${initial}</div>
            <div class="cbody">
              <h6>${safeName}</h6>
              <span class="date">همین الان</span>
              <p>${safeText}</p>
            </div>
          `;
          commentList.appendChild(newComment);

          requestAnimationFrame(() => {
            newComment.style.transition = "all 0.5s var(--ease)";
            newComment.style.opacity = "1";
            newComment.style.transform = "translateY(0)";
          });

          // ── آپدیت شمارنده ──
          if (commentCount) {
            const current = parsePersianNumber(commentCount.textContent);
            commentCount.textContent = current + 1;
          }

          // ── پاک کردن فرم ──
          commentForm.reset();
        })
        .catch((err) => {
          console.error("Comment error:", err);
          alert("ارتباط با سرور برقرار نشد. لطفاً دوباره تلاش کنید.");
        })
        .finally(() => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnText;
        });
    });
  }
});


// ===== کاستم کرسر =====
if (window.matchMedia("(pointer:fine)").matches) {
  document.body.classList.add("has-cursor");
  const dot = document.getElementById("curDot");
  const ring = document.getElementById("curRing");

  if (dot && ring) {
    let mx = 0, my = 0, rx = 0, ry = 0;
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
      .querySelectorAll("a, button, .theme-switch, .burger, .comment-item, .related-item, .sidebar-cat-list a, .post-tags a, .share-bar a, input, textarea")
      .forEach((el) => {
        el.addEventListener("mouseenter", () => ring.classList.add("hover"));
        el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
      });
  }
}