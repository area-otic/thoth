window.assetsPath = document.documentElement.getAttribute("data-assets-path"), window.templateName = document.documentElement.getAttribute("data-template"), window.config = {
    colors: {
        black: window.Helpers.getCssVar("pure-black"),
        white: window.Helpers.getCssVar("white")
    }
}, "undefined" != typeof TemplateCustomizer && (window.templateCustomizer = new TemplateCustomizer({
    displayCustomizer: !1,
    controls: ["color", "theme", "rtl"]
}));