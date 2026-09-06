    // ===== theme =====
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
      document.getElementById("themeSwitch").addEventListener("click", () => {
        applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
      });
      document.getElementById("themeSwitchMobile").addEventListener("click", () => {
        applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
      });

      // ===== هدر و اسکرول =====
      const header = document.getElementById("siteHeader");
      const toTopBtn = document.getElementById("toTop");
      const scrollProgress = document.getElementById("scrollProgress");
      window.addEventListener("scroll", () => {
        header.classList.toggle("scrolled", window.scrollY > 40);
        toTopBtn.classList.toggle("show", window.scrollY > 600);
        const h = document.documentElement;
        const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
        scrollProgress.style.setProperty("--sp", pct + "%");
      });
      toTopBtn.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));

      // ===== منو موبایل =====
      const panel = document.getElementById("mnavPanel");
      const backdrop = document.getElementById("mnavBackdrop");
      document.getElementById("burgerBtn").addEventListener("click", () => {
        panel.classList.add("open");
        backdrop.classList.add("show");
      });
      document.getElementById("closeDrawer").addEventListener("click", () => {
        panel.classList.remove("open");
        backdrop.classList.remove("show");
      });
      backdrop.addEventListener("click", () => {
        panel.classList.remove("open");
        backdrop.classList.remove("show");
      });
      panel.querySelectorAll("[data-close]").forEach((el) =>
        el.addEventListener("click", () => {
          panel.classList.remove("open");
          backdrop.classList.remove("show");
        })
      );

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
      let liked = false;
      let likeCount = 89;
      const likeBtn = document.getElementById("likeBtn");
      likeBtn.addEventListener("click", () => {
        liked = !liked;
        likeCount += liked ? 1 : -1;
        likeBtn.textContent = " " + likeCount;
        likeBtn.style.color = liked ? "var(--accent)" : "var(--text-dim)";
        likeBtn.className = liked ? "fa-solid fa-heart" : "fa-regular fa-heart";
        likeBtn.style.cursor = "pointer";
      });

      // ===== نظر جدید =====
      const submitBtn = document.getElementById("submitComment");
      const commentList = document.getElementById("commentList");
      const commentCount = document.getElementById("commentCount");
      const successMsg = document.getElementById("commentSuccess");

      submitBtn.addEventListener("click", () => {
        const name = document.getElementById("commentName").value.trim();
        const text = document.getElementById("commentText").value.trim();

        if (!name || !text) {
          alert("لطفاً نام و متن نظر را وارد کنید.");
          return;
        }

        const colors = [
          "linear-gradient(135deg, var(--brand), var(--accent-2))",
          "linear-gradient(135deg, var(--accent), var(--brand))",
          "linear-gradient(135deg, var(--accent-2), var(--brand))",
        ];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];
        const initial = name.charAt(0).toUpperCase();

        const newComment = document.createElement("div");
        newComment.className = "comment-item";
        newComment.style.opacity = "0";
        newComment.style.transform = "translateY(20px)";
        newComment.innerHTML = `
          <div class="cav" style="background: ${randomColor}">${initial}</div>
          <div class="cbody">
            <h6>${name}</h6>
            <span class="date">همین الان</span>
            <p>${text}</p>
            <span class="reply-btn"><i class="fa-regular fa-reply"></i> پاسخ</span>
          </div>
        `;

        commentList.appendChild(newComment);

        requestAnimationFrame(() => {
          newComment.style.transition = "all 0.5s var(--ease)";
          newComment.style.opacity = "1";
          newComment.style.transform = "translateY(0)";
        });

        const currentCount = parseInt(commentCount.textContent);
        commentCount.textContent = currentCount + 1;

        successMsg.style.display = "block";
        successMsg.style.opacity = "0";
        successMsg.style.transform = "translateY(10px)";
        requestAnimationFrame(() => {
          successMsg.style.transition = "all 0.4s var(--ease)";
          successMsg.style.opacity = "1";
          successMsg.style.transform = "translateY(0)";
        });

        document.getElementById("commentName").value = "";
        document.getElementById("commentEmail").value = "";
        document.getElementById("commentText").value = "";

        setTimeout(() => {
          successMsg.style.opacity = "0";
          successMsg.style.transform = "translateY(10px)";
          setTimeout(() => {
            successMsg.style.display = "none";
          }, 400);
        }, 4000);
      });

      // ===== کاستم کرسر =====
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
            "a, button, .theme-switch, .burger, .comment-item, .related-item, .sidebar-cat-list a, .post-tags a, .share-bar a, input, textarea"
          )
          .forEach((el) => {
            el.addEventListener("mouseenter", () => ring.classList.add("hover"));
            el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
          });
      }