
      const faDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
      function toFa(n) {
        return String(n).replace(/[0-9]/g, (d) => faDigits[d]);
      }

      /* theme */
      const root = document.documentElement;
      const themeIcon = document.getElementById("themeIcon");
      function applyTheme(t) {
        root.setAttribute("data-theme", t);
        themeIcon.className =
          t === "dark" ? "fa-solid fa-moon" : "fa-solid fa-sun";
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
        applyTheme(
          root.getAttribute("data-theme") === "dark" ? "light" : "dark",
        );
      }
      document
        .getElementById("themeSwitch")
        .addEventListener("click", toggleTheme);
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
      document
        .getElementById("closeDrawer")
        .addEventListener("click", closeMenu);
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

      /* cursor glow on cards */
      document.querySelectorAll(".svc-card").forEach((card) => {
        card.addEventListener("mousemove", (e) => {
          const r = card.getBoundingClientRect();
          card.style.setProperty("--mx", e.clientX - r.left + "px");
          card.style.setProperty("--my", e.clientY - r.top + "px");
        });
      });

      /* counters */
      function animateCounter(el) {
        const target = +el.dataset.target;
        const dur = 1500;
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

      /* gallery tabs */
      document.querySelectorAll(".gal-tab").forEach((tab) => {
        tab.addEventListener("click", () => {
          document
            .querySelectorAll(".gal-tab")
            .forEach((t) => t.classList.remove("active"));
          tab.classList.add("active");
          const target = tab.dataset.tab;
          document
            .querySelectorAll(".gal-grid")
            .forEach((g) =>
              g.classList.toggle("hidden", g.dataset.panel !== target),
            );
        });
      });

      /* lightbox */
      const lightbox = document.getElementById("lightbox");
      const lightboxInner = document.getElementById("lightboxInner");
      document.querySelectorAll(".gal-item").forEach((item) => {
        item.addEventListener("click", () => {
          const ph = item.querySelector(".ph");
          lightboxInner.querySelectorAll(".ph").forEach((p) => p.remove());
          const clone = ph.cloneNode(true);
          lightboxInner.appendChild(clone);
          lightbox.classList.add("show");
        });
      });
      document
        .getElementById("lightboxClose")
        .addEventListener("click", () => lightbox.classList.remove("show"));
      lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) lightbox.classList.remove("show");
      });

      /* side quick-nav active state */
      const sideLinks = document.querySelectorAll(".side-nav a");
      window.addEventListener("scroll", () => {
        let current = "";
        document.querySelectorAll("section[id]").forEach((sec) => {
          if (window.scrollY >= sec.offsetTop - 200)
            current = sec.getAttribute("id");
        });
        sideLinks.forEach((a) =>
          a.classList.toggle(
            "active",
            a.getAttribute("href") === "#" + current,
          ),
        );
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
            "a, button, .svc-card, .gal-item, .tech-pill, .sim-card, input, textarea, .theme-switch",
          )
          .forEach((el) => {
            el.addEventListener("mouseenter", () =>
              ring.classList.add("hover"),
            );
            el.addEventListener("mouseleave", () =>
              ring.classList.remove("hover"),
            );
          });
      }
