import { Link, usePage } from "@inertiajs/vue3";
import { resolveComponent, withCtx, createTextVNode, useSSRContext, mergeProps } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderAttr, ssrRenderSlot } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-1tPrXgE0.js";
const _sfc_main$2 = {
  components: {
    Link
  },
  computed: {
    currentComponent() {
      return usePage().component;
    }
  },
  methods: {
    isActiveTab(name) {
      return this.currentComponent === name;
    }
  }
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Link = resolveComponent("Link");
  _push(`<div${ssrRenderAttrs(_attrs)}><ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-800"><li>`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("compare"),
    class: ["py-2 px-3 rounded-sm", $options.isActiveTab("Compare") ? "theme-bg-primary text-white" : "hover:bg-gray-100 dark:hover:bg-gray-700"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(` Comparação `);
      } else {
        return [
          createTextVNode(" Comparação ")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li><li>`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("consolidated"),
    class: ["py-2 px-3 rounded-sm", $options.isActiveTab("Consolidated") ? "theme-bg-primary text-white" : "hover:bg-gray-100 dark:hover:bg-gray-700"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(` Consolidado `);
      } else {
        return [
          createTextVNode(" Consolidado ")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></div>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/TabNavigation.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const TabNavigation = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _imports_0 = "/build/assets/app-icon-CieYFFjb.svg";
const _sfc_main$1 = {
  name: "AppLayout",
  components: {
    TabNavigation
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_TabNavigation = resolveComponent("TabNavigation");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "antialiased bg-gray-100 dark:bg-gray-900 dark:text-gray-100 min-h-screen" }, _attrs))}><nav class="bg-white border-gray-200 dark:bg-gray-800"><div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"><a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse"><img${ssrRenderAttr("src", _imports_0)} class="h-8" alt="Logo"><span class="self-center text-2xl font-semibold whitespace-nowrap">Babilonia</span></a><div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">`);
  _push(ssrRenderComponent(_component_TabNavigation, null, null, _parent));
  _push(`</div><div class="flex md:order-2 rtl:space-x-reverse items-center space-x-4"></div></div></nav><main class="flex-grow mx-4">`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</main></div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/App.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const AppLayout = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  _push(`<section${ssrRenderAttrs(mergeProps({ class: "mt-5" }, _attrs))}><div class="w-full px-4 lg:px-12"><div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</div></div></section>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Section.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Section = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  AppLayout as A,
  Section as S
};
