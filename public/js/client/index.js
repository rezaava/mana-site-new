const faDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];

function toFa(n) {
    return String(n).replace(/[0-9]/g, d => faDigits[d]);
}

/* =========================================================
   THEME
========================================================= */

const root = document.documentElement;
const themeIcon = document.getElementById("themeIcon");

function applyTheme(t) {
    root.setAttribute("data-theme", t);

    if (themeIcon) {
        themeIcon.className =
            t === "dark"
                ? "fa-solid fa-moon"
                : "fa-solid fa-sun";
    }

    try {
        localStorage.setItem("novinai-theme", t);
    } catch (e) {}
}

let savedTheme = "dark";

try {
    savedTheme =
        localStorage.getItem("novinai-theme") || "dark";
} catch (e) {}

applyTheme(savedTheme);

function toggleTheme() {
    applyTheme(
        root.getAttribute("data-theme") === "dark"
            ? "light"
            : "dark"
    );
}

const themeSwitch =
    document.getElementById("themeSwitch");

const themeSwitchMobile =
    document.getElementById("themeSwitchMobile");

if (themeSwitch) {
    themeSwitch.addEventListener("click", toggleTheme);
}

if (themeSwitchMobile) {
    themeSwitchMobile.addEventListener(
        "click",
        toggleTheme
    );
}


/* =========================================================
   HEADER / SCROLL
========================================================= */

const header =
    document.getElementById("siteHeader");

const toTop =
    document.getElementById("toTop");

const scrollProgress =
    document.getElementById("scrollProgress");

window.addEventListener("scroll", () => {

    if (header) {
        header.classList.toggle(
            "scrolled",
            window.scrollY > 40
        );
    }

    if (toTop) {
        toTop.classList.toggle(
            "show",
            window.scrollY > 600
        );
    }

    if (scrollProgress) {

        const h = document.documentElement;

        const max =
            h.scrollHeight - h.clientHeight;

        const pct =
            max > 0
                ? (h.scrollTop / max) * 100
                : 0;

        scrollProgress.style.setProperty(
            "--sp",
            pct + "%"
        );
    }
});

if (toTop) {
    toTop.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
}


/* =========================================================
   MOBILE MENU
========================================================= */

const panel =
    document.getElementById("mnavPanel");

const backdrop =
    document.getElementById("mnavBackdrop");

function openMenu() {

    if (panel) {
        panel.classList.add("open");
    }

    if (backdrop) {
        backdrop.classList.add("show");
    }
}

function closeMenu() {

    if (panel) {
        panel.classList.remove("open");
    }

    if (backdrop) {
        backdrop.classList.remove("show");
    }
}

const burgerBtn =
    document.getElementById("burgerBtn");

const closeDrawer =
    document.getElementById("closeDrawer");

if (burgerBtn) {
    burgerBtn.addEventListener(
        "click",
        openMenu
    );
}

if (closeDrawer) {
    closeDrawer.addEventListener(
        "click",
        closeMenu
    );
}

if (backdrop) {
    backdrop.addEventListener(
        "click",
        closeMenu
    );
}

if (panel) {

    panel
        .querySelectorAll("[data-close]")
        .forEach(el => {

            el.addEventListener(
                "click",
                closeMenu
            );

        });
}


/* =========================================================
   ACTIVE NAV
========================================================= */

const navLinks =
    document.querySelectorAll(".main-nav a");

window.addEventListener("scroll", () => {

    let current = "";

    document
        .querySelectorAll("section[id], .hero[id]")
        .forEach(sec => {

            if (
                window.scrollY >=
                sec.offsetTop - 140
            ) {
                current =
                    sec.getAttribute("id");
            }

        });

    navLinks.forEach(a => {

        a.classList.toggle(
            "active",
            a.getAttribute("href") ===
            "#" + current
        );

    });
});


/* =========================================================
   REVEAL ANIMATION
========================================================= */

const revealEls =
    document.querySelectorAll(".reveal");

if ("IntersectionObserver" in window) {

    const io =
        new IntersectionObserver(
            entries => {

                entries.forEach(e => {

                    if (e.isIntersecting) {

                        e.target.classList.add("in");

                        io.unobserve(e.target);
                    }

                });

            },
            {
                threshold: 0.15
            }
        );

    revealEls.forEach(el =>
        io.observe(el)
    );

} else {

    revealEls.forEach(el =>
        el.classList.add("in")
    );

}


/* =========================================================
   SERVICE CARD MOUSE EFFECT
========================================================= */

document
    .querySelectorAll(".svc-card")
    .forEach(card => {

        card.addEventListener(
            "mousemove",
            e => {

                const r =
                    card.getBoundingClientRect();

                card.style.setProperty(
                    "--mx",
                    e.clientX -
                    r.left +
                    "px"
                );

                card.style.setProperty(
                    "--my",
                    e.clientY -
                    r.top +
                    "px"
                );

            }
        );

    });


/* =========================================================
   FAQ
========================================================= */

document
    .querySelectorAll(".acc-item")
    .forEach(item => {

        const btn =
            item.querySelector(".acc-btn");

        const panelEl =
            item.querySelector(".acc-panel");

        if (!btn || !panelEl) return;

        if (
            item.classList.contains("open")
        ) {
            panelEl.style.maxHeight =
                panelEl.scrollHeight + "px";
        }

        btn.addEventListener(
            "click",
            () => {

                const isOpen =
                    item.classList.contains("open");

                document
                    .querySelectorAll(".acc-item")
                    .forEach(i => {

                        i.classList.remove("open");

                        const p =
                            i.querySelector(
                                ".acc-panel"
                            );

                        if (p) {
                            p.style.maxHeight =
                                null;
                        }

                    });

                if (!isOpen) {

                    item.classList.add("open");

                    panelEl.style.maxHeight =
                        panelEl.scrollHeight +
                        "px";
                }

            }
        );

    });


/* =========================================================
   COUNTERS
========================================================= */

function animateCounter(el) {

    const target =
        +el.dataset.target;

    const dur = 1600;

    const start =
        performance.now();

    function step(now) {

        const p =
            Math.min(
                (now - start) / dur,
                1
            );

        const eased =
            1 -
            Math.pow(
                1 - p,
                3
            );

        el.textContent =
            toFa(
                Math.round(
                    eased * target
                )
            );

        if (p < 1) {
            requestAnimationFrame(step);
        }
    }

    requestAnimationFrame(step);
}

const statStrip =
    document.querySelector(".stat-strip");

if (
    statStrip &&
    "IntersectionObserver" in window
) {

    const cio =
        new IntersectionObserver(
            entries => {

                entries.forEach(e => {

                    if (e.isIntersecting) {

                        document
                            .querySelectorAll(
                                ".count-num"
                            )
                            .forEach(
                                animateCounter
                            );

                        cio.unobserve(
                            e.target
                        );
                    }

                });

            },
            {
                threshold: 0.4
            }
        );

    cio.observe(statStrip);
}


/* =========================================================
   PROJECTS / PORTFOLIO
========================================================= */

const folioTabs =
    document.getElementById("folioTabs");

const folioMobileTabs =
    document.getElementById(
        "folioMobileTabs"
    );

const fpBg =
    document.getElementById("fpBg");

const fpContent =
    document.getElementById("fpContent");

const fpDots =
    document.getElementById("fpDots");

const tabData = [];

let currentFolioIndex = 0;

let visibleFolioIndexes = [];


/*
|--------------------------------------------------------------------------
| ساخت اطلاعات پروژه‌ها
|--------------------------------------------------------------------------
*/

if (folioTabs) {

    [
        ...folioTabs.children
    ].forEach((tab, index) => {

        const title =
            tab
                .querySelector("h5")
                ?.textContent
                .trim() || "";

        const tag =
            tab
                .querySelector("span")
                ?.textContent
                .trim() || "";

        const icon =
            tab
                .querySelector("i")
                ?.className || "";

        const projectId =
            tab.dataset.project ||
            tab.dataset.index ||
            index;

        tabData.push({

            index: index,

            id: projectId,

            category:
                tab.dataset.category || "",

            title: title,

            tag: tag,

            desc:
                tab.dataset.description || "",

            from:
                tab.dataset.from ||
                "#1d2a6b",

            to:
                tab.dataset.to ||
                "#0b1030",

            image:
                tab.dataset.image || "",

            url:
                tab.dataset.url || "#",

            icon: icon
        });

    });

}


/*
|--------------------------------------------------------------------------
| پروژه‌های قابل مشاهده
|--------------------------------------------------------------------------
*/

function getVisibleFolioIndexes() {

    if (!folioTabs) {
        return [];
    }

    return [
        ...folioTabs.children
    ]
        .map((tab, index) => {

            return tab.style.display !== "none"
                ? index
                : null;

        })
        .filter(index => index !== null);
}


/*
|--------------------------------------------------------------------------
| ساخت Dots
|--------------------------------------------------------------------------
*/

function renderFolioDots() {

    if (!fpDots) return;

    fpDots.innerHTML = "";

    visibleFolioIndexes.forEach(
        projectIndex => {

            const dot =
                document.createElement("span");

            if (
                projectIndex ===
                currentFolioIndex
            ) {
                dot.classList.add("active");
            }

            dot.addEventListener(
                "click",
                () => {

                    setFolio(
                        projectIndex
                    );

                }
            );

            fpDots.appendChild(dot);

        }
    );
}


/*
|--------------------------------------------------------------------------
| نمایش پروژه
|--------------------------------------------------------------------------
*/

function setFolio(index) {

    const tab =
        tabData[index];

    if (!tab) return;

    currentFolioIndex =
        index;

    /*
     * Fade out
     */
    if (fpContent) {

        fpContent.style.opacity = "0";

        fpContent.style.transform =
            "translateY(10px)";
    }

    if (fpBg) {
        fpBg.style.opacity = "0";
    }


    /*
     * بعد از انیمیشن
     */
    setTimeout(() => {

        if (fpBg) {

            fpBg.src =
                tab.image;

            fpBg.alt =
                tab.title;
        }

        if (fpContent) {

            fpContent.innerHTML = `
                <span class="tag">
                    ${tab.tag}
                </span>

                <h4>
                    ${tab.title}
                </h4>

                <p>
                    ${tab.desc}
                </p>

                <a
                    href="${tab.url}"
                    class="pill"
                >
                    مشاهده جزئیات
                    <i class="fa-solid fa-arrow-up-left"></i>
                </a>
            `;

            fpContent.style.opacity =
                "1";

            fpContent.style.transform =
                "translateY(0)";
        }

        if (fpBg) {
            fpBg.style.opacity =
                "1";
        }

    }, 220);


    /*
     * Active کردن پروژه
     */
    if (folioTabs) {

        [
            ...folioTabs.children
        ].forEach(
            (el, i) => {

                el.classList.toggle(
                    "active",
                    i === index
                );

            }
        );

    }


    /*
     * Dots
     */
    if (fpDots) {

        [
            ...fpDots.children
        ].forEach(dot => {

            dot.classList.remove(
                "active"
            );

        });

        const dotIndex =
            visibleFolioIndexes.indexOf(
                index
            );

        if (
            dotIndex !== -1 &&
            fpDots.children[dotIndex]
        ) {

            fpDots.children[
                dotIndex
            ].classList.add("active");

        }

    }

}


/*
|--------------------------------------------------------------------------
| فیلتر دسته‌بندی
|--------------------------------------------------------------------------
*/

function applyCategoryFilter(chip) {

    if (!folioTabs || !chip) {
        return;
    }

    /*
     * فعال کردن دسته
     */
    if (folioMobileTabs) {

        [
            ...folioMobileTabs.children
        ].forEach(c => {

            c.classList.remove(
                "active"
            );

        });

        chip.classList.add("active");
    }


    const category =
        chip.dataset.category || "";


    /*
     * فیلتر پروژه‌ها
     */
    [
        ...folioTabs.children
    ].forEach((tab, index) => {

        const tabCategory =
            tab.dataset.category || "";

        if (
            tabCategory === category
        ) {

            tab.style.display = "";

        } else {

            tab.style.display =
                "none";

            tab.classList.remove(
                "active"
            );
        }

    });


    /*
     * گرفتن پروژه‌های قابل نمایش
     */
    visibleFolioIndexes =
        getVisibleFolioIndexes();


    /*
     * اگر دسته پروژه نداشت
     */
    if (
        visibleFolioIndexes.length === 0
    ) {

        currentFolioIndex = 0;

        if (fpDots) {
            fpDots.innerHTML = "";
        }

        return;
    }


    /*
     * پروژه فعلی اگر در دسته جدید نبود
     * برو روی اولین پروژه
     */
    if (
        !visibleFolioIndexes.includes(
            currentFolioIndex
        )
    ) {

        currentFolioIndex =
            visibleFolioIndexes[0];

    }


    /*
     * Dots جدید
     */
    renderFolioDots();


    /*
     * نمایش پروژه
     */
    setFolio(
        currentFolioIndex
    );
}


/*
|--------------------------------------------------------------------------
| کلیک روی پروژه‌ها
|--------------------------------------------------------------------------
*/

if (folioTabs) {

    [
        ...folioTabs.children
    ].forEach((tab, index) => {

        tab.addEventListener(
            "click",
            () => {

                if (
                    tab.style.display ===
                    "none"
                ) {
                    return;
                }

                setFolio(index);

            }
        );

    });

}


/*
|--------------------------------------------------------------------------
| دسته‌بندی‌ها
|--------------------------------------------------------------------------
*/

if (
    folioMobileTabs &&
    folioMobileTabs.children.length > 0
) {

    [
        ...folioMobileTabs.children
    ].forEach(chip => {

        chip.addEventListener(
            "click",
            () => {

                applyCategoryFilter(
                    chip
                );

            }
        );

    });


    /*
     * دسته اول در شروع
     */
    applyCategoryFilter(
        folioMobileTabs.children[0]
    );

} else {

    visibleFolioIndexes =
        getVisibleFolioIndexes();

    if (
        visibleFolioIndexes.length > 0
    ) {

        renderFolioDots();

        setFolio(
            visibleFolioIndexes[0]
        );
    }

}


/* =========================================================
   CUSTOM CURSOR
========================================================= */

if (
    window.matchMedia(
        "(pointer:fine)"
    ).matches
) {

    document.body.classList.add(
        "has-cursor"
    );

    const dot =
        document.getElementById(
            "curDot"
        );

    const ring =
        document.getElementById(
            "curRing"
        );

    if (dot && ring) {

        let mx = 0;
        let my = 0;

        let rx = 0;
        let ry = 0;

        window.addEventListener(
            "mousemove",
            e => {

                mx = e.clientX;
                my = e.clientY;

                dot.style.transform =
                    `translate(${mx}px,${my}px) translate(-50%,-50%)`;

            }
        );

        function loop() {

            rx +=
                (mx - rx) *
                0.16;

            ry +=
                (my - ry) *
                0.16;

            ring.style.transform =
                `translate(${rx}px,${ry}px) translate(-50%,-50%)`;

            requestAnimationFrame(
                loop
            );
        }

        loop();

        document
            .querySelectorAll(
                "a,button,.svc-card,.folio-tab,.team-card,input,textarea,.theme-switch,.mnav-panel nav a,.chat-fab,.fmt-chip"
            )
            .forEach(el => {

                el.addEventListener(
                    "mouseenter",
                    () => {

                        ring.classList.add(
                            "hover"
                        );

                    }
                );

                el.addEventListener(
                    "mouseleave",
                    () => {

                        ring.classList.remove(
                            "hover"
                        );

                    }
                );

            });

    }

}


/* =========================================================
   TEAM SLIDER
========================================================= */

(function () {

    const slider =
        document.getElementById(
            "teamSlider"
        );

    if (!slider) return;

    const originals =
        Array.from(
            slider.children
        );

    if (originals.length < 2) {
        return;
    }

    const GAP = 22;

    const COUNT =
        originals.length;

    const fragment =
        document.createDocumentFragment();

    originals.forEach(card => {

        const clone =
            card.cloneNode(true);

        clone.setAttribute(
            "aria-hidden",
            "true"
        );

        fragment.appendChild(
            clone
        );

    });

    slider.insertBefore(
        fragment,
        slider.firstChild
    );

    let index = 0;
    let step = 0;
    let baseOffset = 0;
    let paused = false;


    function calcStep() {

        step =
            originals[0].offsetWidth +
            GAP;

        baseOffset =
            step * COUNT;
    }


    function reset() {

        index = 0;

        slider.style.transition =
            "none";

        slider.style.transform =
            `translateX(${baseOffset}px)`;
    }


    function move() {

        if (paused) return;

        index++;

        const x =
            baseOffset -
            step * index;

        slider.style.transition =
            "transform 0.8s cubic-bezier(0.22, 1, 0.36, 1)";

        slider.style.transform =
            `translateX(${x}px)`;

        if (index >= COUNT) {

            setTimeout(
                reset,
                850
            );
        }

    }


    function init() {

        calcStep();

        reset();
    }


    slider.addEventListener(
        "mouseenter",
        () => {
            paused = true;
        }
    );

    slider.addEventListener(
        "mouseleave",
        () => {
            paused = false;
        }
    );

    slider.addEventListener(
        "touchstart",
        () => {
            paused = true;
        },
        {
            passive: true
        }
    );

    slider.addEventListener(
        "touchend",
        () => {

            setTimeout(
                () => {
                    paused = false;
                },
                1500
            );

        }
    );

    window.addEventListener(
        "resize",
        init
    );

    init();

    setInterval(
        move,
        2000
    );

})();
